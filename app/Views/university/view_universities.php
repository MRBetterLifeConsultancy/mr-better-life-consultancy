<?php
    $region_brief_document = "";
    if($selected_region['brief_document'] != null)
    {
        $region_brief_document = json_decode($selected_region['brief_document'], true);
    }
?>
<main class="main">
    <!-- Page Title -->
    <div class="page-title dark-background" data-aos="fade" style="background-image: url(<?php echo $custom_site_url; ?>assets/img/region-images/<?php echo $region_brief_document['image_2_url'] ?>);">
    <div class="container">
        <h1>List of top universities in <?php echo $selected_region['region_name'] == '' ? $selected_region['region_name'] : $selected_region['shortcode'] ?></h1>
        <nav class="breadcrumbs">
        <ol>
            <li><a href="index.html">Home</a></li>
            <li class="current">Universities</li>
        </ol>
        </nav>
    </div>
</div><!-- End Page Title -->
    <section id="services" class="services light-background1">
        <form id="quickForm" name="quickForm">
            <div class="container mb-5">
                <div class="row justify-content-center align-items-center">
                    <div class="col-md-5 search-form">
                        <div class="form-group">
                            <h3 class="mb-3 text-center">Select Study Destination</h3>
                            <select class="form-control custom-select2" data-toggle="select2" name="region" onchange="getRegionList(event, this)">
                                <!-- <option value="">All</option> -->
                                <?php
                                $selected = "";
                                foreach ($regions as $region)
                                {
                                    $selected = "";
                                    if ($r_id == $region['region_id'])
                                    {
                                        $selected = "selected";
                                    }
                                    ?>
                                    <option  <?php echo $selected ?> value="<?php echo $region['region_id'] ?>"><?php echo $region['region_name'] ?></option>
                                    <?php
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                </div> 
            </div>
            <div class="container">
                <div class="d-flex justify-content-between align-items-center py-2">
                    <div class="">
                        <h6>Showing Results in <?php echo $selected_region['region_name']; ?></h6>
                    </div>
                    <div class="form-group d-flex justify-content-between align-items-center" tyle="max-width:250px;">
                        <input name="university" class="form-control" oninput="searchUniversityByName(event)" value="<?php echo $u_name ?>">
                        <i class="fas fa-search mx-2"></i>
                    </div>
                </div>
            </div>
        </form>
        <div class="container">
            <div class="row" name="universities_list">
                <?php
                    $i = 1;
                    foreach($universities as $ids => $university)
                    {
                        $brief_doc = json_decode($university['brief_document'], true);
                ?>
                <div class="col-md-12 mb-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-10">
                                    <h4 class="service-title"><?php echo $university['university_name'] ?></h4>
                                    <p><?php echo $university['website'] ?></p>
                                </div>
                                <div class="col-2">
                                    <img class="img-fluid" src="<?php echo $custom_site_url ?>assets/img/universities/<?php echo $university['logo'] ?>" alt="service image cap">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
                        $i += 1;
                    }
                ?>
            </div>
        </div>
    </section>

    <!-- University Pagination Section -->
    <section id="blog-pagination" class="blog-pagination section light-background">
        <div class="container">
            <div class="d-flex justify-content-center" name="pagenation_div">
                <?php
                    $total_count = $universities_count;
                    $page_record_limit = $limit;
                    $no_of_pages = ceil($total_count/$page_record_limit);

                    $prev_offset = ($offset - $page_record_limit) >= 0 ? ($offset - $page_record_limit) : $offset;
                    $next_offset = ($offset + $page_record_limit) < $total_count ? ($offset + $page_record_limit) : $offset;
                ?>     
                <ul>
                    <li><a href="#" data-page_offset = <?php echo $prev_offset ?>  onclick="getPage(event, this)"><i class="bi bi-chevron-left"></i></a></li>
                    <?php
                        for($i = 0; $i < $no_of_pages; $i++) 
                        {
                            $page_offset = $i * $page_record_limit;
                    ?>
                    <li>
                        <a href="#" <?php echo $offset == $page_offset ? 'class = "active"' : ''; ?> data-page_no = <?php echo $i ?> data-page_offset = <?php echo $page_offset ?> onclick="getPage(event, this)" ><?php echo $i+1 ?></a>
                    </li>
                    <?php
                        }
                    ?>
                    <li><a href="#" onclick="getPage(event, this)" data-page_offset = <?php echo $next_offset ?>><i class="bi bi-chevron-right"></i></a></li>
                </ul>
            </div>
        </div>
    </section><!-- /University Pagination Section -->
</main>

<script>
    var total_no_of_pages = <?php echo $no_of_pages ?>;
    var offset = <?php echo $offset ?>;

    function getPage(ev, e)
    {
        offset = $(e).data('page_offset');
        searchUniversities(ev);
    }

    function getRegionList(ev, e)
    {
        offset = 0;
        searchUniversities(ev);
    }

    function searchUniversityByName(ev, e = null)
    {
        // enableDisableDiv('#quickForm', false);
        var region = $('#quickForm').find('[name="region"]').val();
        var university = $('#quickForm').find('[name="university"]').val();

        var submitData = {};
        submitData['region_id'] = region;
        submitData['university_name'] = university;
        submitData['offset'] = 0;

        var submittedData = {
            'submittedData': submitData
        };
        $.ajax({
            url: '<?php echo $custom_site_url . $controller; ?>/ajax_request/university/universities_list_ol',
            datatype: 'json',
            type: 'POST',
            data: submittedData,
            success: function (response)
            {
                enableDisableDiv('#quickForm', true);
                var receivedData = $.parseJSON(response);
                if (receivedData.success == 1)
                {
                    row_template = '';
                    receivedDataArray = receivedData.universities;
                    $.each(receivedDataArray, (idx, row) => {
                        row_template += '<div class="col-md-12 mb-3"><div class="card"><div class="card-body"><div class="row align-items-center"><div class="col-10"><h4 class="service-title">'+ row.university_name +'</h4><p>'+ row.website +'</p></div><div class="col-2"><img class="img-fluid" src="<?php echo $custom_site_url ?>assets/img/universities/'+ row.logo +'" alt="service image cap"></div></div></div></div></div>';
                    });
                    $('[name="universities_list"]').html(row_template);

                    pagenation_template = '';
                    total_count = receivedData.universities_count;
                    page_record_limit = <?php echo UNIVERSITY_PAGE_LIMIT ?>;
                    no_of_pages = Math.ceil(total_count/page_record_limit);

                    prev_offset = (offset - page_record_limit) >= 0 ? (offset - page_record_limit) : offset;
                    next_offset = (offset + page_record_limit) < total_count ? (offset + page_record_limit) : offset;

                    pagenation_template = '<ul><li><a href="#" data-page_offset = '+ prev_offset +' onclick="getPage(event, this)"><i class="bi bi-chevron-left"></i></a></li>';

                    for(i = 0; i < no_of_pages; i++) 
                    {
                        page_offset = i * page_record_limit;
                        pagenation_template += '<li><a href="#" '+ (offset == page_offset ? 'class = "active"' : '') + ' data-page_no = '+ i +' data-page_offset = '+ page_offset +' onclick="getPage(event, this)" >'+ (i+1) +'</a></li>';
                    }
                    pagenation_template += '<li><a href="#" onclick="getPage(event, this)" data-page_offset = <?php echo $next_offset ?>><i class="bi bi-chevron-right"></i></a></li></ul>';

                    $('[name="pagenation_div"]').html(pagenation_template);
                }
                else
                {
                    toastr.error(receivedData.message);
                }

            },
            error: function ()
            {
                enableDisableDiv('#quickForm', true);
                toastr.error("Refresh the page and try again");
            }
        });
    }

    function searchUniversities(ev, e = null)
    {
        ev.preventDefault();
        enableDisableDiv('#quickForm', false);
        var region = $('#quickForm').find('[name="region"]').val();
        var university = $('#quickForm').find('[name="university"]').val();

        var submitData = {};
        submitData['region'] = region;
        submitData['university'] = university;
        submitData['offset'] = offset;

        var submittedData = {
            'submittedData': submitData
        };
        $.ajax({
            url: '<?php echo $custom_site_url . $controller; ?>/universities/search',
            datatype: 'json',
            type: 'POST',
            data: submittedData,
            success: function (response)
            {
                enableDisableDiv('#quickForm', true);
                var receivedData = $.parseJSON(response);
                if (receivedData.success == 1)
                {
                    if (receivedData.redirect_url)
                    {
                        window.location.href = receivedData.redirect_url;
                    }
                }
                else
                {
                    toastr.error(receivedData.message);
                }

            },
            error: function ()
            {
                enableDisableDiv('#quickForm', true);
                toastr.error("Refresh the page and try again");
            }
        });
    }

</script>