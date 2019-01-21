<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
  <div class="page-header">
    <div class="container-fluid">
      <div class="pull-right">
        <button type="button" data-toggle="tooltip" title="<?php echo $button_delete; ?>" class="btn btn-danger" onclick="confirm('<?php echo $text_confirm; ?>') ? $('#form-manufacturer').submit() : false;"><i class="fa fa-trash-o"></i></button>
       
      </div>
      <h1><?php echo $heading_title; ?></h1>
      <ul class="breadcrumb">
        <?php foreach ($breadcrumbs as $breadcrumb) { ?>
        <li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
        <?php } ?>
      </ul>
    </div>
  </div>
  <div class="container-fluid">
    <?php if ($error_warning) { ?>
    <div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> <?php echo $error_warning; ?>
      <button type="button" class="close" data-dismiss="alert">&times;</button>
    </div>
    <?php } ?>
    <?php if ($success) { ?>
    <div class="alert alert-success"><i class="fa fa-check-circle"></i> <?php echo $success; ?>
      <button type="button" class="close" data-dismiss="alert">&times;</button>
    </div>
    <?php } ?>
    <div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title"><i class="fa fa-list"></i> <?php echo $text_list; ?></h3>
      </div>
      <div class="panel-body">
        <div class="well">
          <div class="row">
            <div class="col-sm-4">
              <div class="form-group">
                <label class="control-label" for="input-filter_company_id"><?php echo $filters_company_name;?> </label>
                <input type="text" name="filter_company_id" value="<?php echo $filter_company_id; ?>" placeholder="<?php echo $filters_company_name; ?>" id="input-filter_company_id" class="form-control" />
                <input type="hidden" name="company_id" value=""/>
              </div>
              </div>
              <div class="col-sm-4">
                <div class="form-group">
                <label class="control-label" for="input-experience"><?php echo $filters_experience;?> </label>
                <input type="text" name="filter_experience" value="<?php echo $filter_experience; ?>" placeholder="<?php echo $filters_experience; ?>" id="input-filter_experience" class="form-control" />
                </div>
              </div>
              <div class="col-sm-2 text-center">
              <button style="margin-top:23%;" type="button" id="button-filter" class="btn btn-primary"><i class="fa fa-filter"></i> <?php echo $button_filter; ?></button>
            </div>    
          </div>
        </div>
        <form action="<?php echo $delete; ?>" method="post" enctype="multipart/form-data" id="form-manufacturer">
          <div class="table-responsive">
            <table class="table table-bordered table-hover">
              <thead>
                <tr>
                  <td style="width: 1px;" class="text-center"><input type="checkbox" onclick="$('input[name*=\'selected\']').prop('checked', this.checked);" /></td>
                  
                  <td class="text-left"><?php if ($sort == 'jd.company_name') { ?>
                    <a href="<?php echo $sort_company_name; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_company_name; ?></a>
                    <?php } else { ?>
                    <a href="<?php echo $sort_company_name; ?>"><?php echo $column_company_name; ?></a>
                    <?php } ?>
                  </td>

                   <td class="text-left"><?php if ($sort == 'jd.title') { ?>
                    <a href="<?php echo $sort_title_name; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_title; ?></a>
                    <?php } else { ?>
                    <a href="<?php echo $sort_title_name; ?>"><?php echo $column_title; ?></a>
                    <?php } ?>
                  </td>


                  <td class="text-left"><?php if ($sort == 'jd.experience') { ?>
                    <a href="<?php echo $sort_experience; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_experience; ?></a>
                    <?php } else { ?>
                    <a href="<?php echo $sort_experience; ?>"><?php echo $column_experience; ?></a>
                    <?php } ?>
                  </td>  

                  <td class="text-left"><?php if ($sort == 'j.location') { ?>
                    <a href="<?php echo $sort_location; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_location; ?></a>
                    <?php } else { ?>
                    <a href="<?php echo $sort_location; ?>"><?php echo $column_location; ?></a>
                    <?php } ?>
                  </td>

                  <td class="text-left"><?php if ($sort == 'j.jobtype_id') { ?>
                    <a href="<?php echo $sort_job_type; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_job_type; ?></a>
                    <?php } else { ?>
                    <a href="<?php echo $sort_job_type; ?>"><?php echo $column_job_type; ?></a>
                    <?php } ?>
                  </td>

                   <td class="text-left"><?php if ($sort == 'j.category_id') { ?>
                    <a href="<?php echo $sort_cate; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_jobtypelist; ?></a>
                    <?php } else { ?>
                    <a href="<?php echo $sort_cate; ?>"><?php echo $column_jobtypelist; ?></a>
                    <?php } ?>
                  </td>

                   <td class="text-left"><?php if ($sort == 'job_type') { ?>
                    <a href="<?php echo $sort_job_type; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_applejob; ?></a>
                    <?php } else { ?>
                    <a href="<?php echo $sort_job_type; ?>"><?php echo $column_applejob; ?></a>
                    <?php } ?>
                  </td>
                  <td class="text-left"><?php echo $column_action; ?></td>
                </tr>
              </thead>
              <tbody>
                <?php if ($lists) { ?>
                <?php foreach ($lists as $list) { ?>
                <tr>
                  <td class="text-center"><?php if (in_array($list['job_id'], $selected)) { ?>
                    <input type="checkbox" name="selected[]" value="<?php echo $list['job_id']; ?>" checked="checked" />
                    <?php } else { ?>
                    <input type="checkbox" name="selected[]" value="<?php echo $list['job_id']; ?>" />
                    <?php } ?></td>
                  <td class="text-left"><?php echo $list['cname'];?></td>
                  <td class="text-left"><?php echo $list['title'];?></td>
                  <td class="text-left"><?php echo $list['experience'];?></td>
                  <td class="text-left"><?php echo $list['location'];?></td>
                  <td class="text-left"><?php echo $list['type'];?></td>
                  <td class="text-left"><?php echo $list['cnametype'];?></td>
                  <td class="text-left"><a href="<?php echo $list['href'];?>"><?php echo $column_applejoblist;?> (Total:<?php echo $list['jobtotal'];?>)</a></td>
                  <td class="text-right"><?php if ($list['approve']) { ?>
                    <a href="<?php echo $list['approve']; ?>" data-toggle="tooltip" title="<?php echo $button_approve; ?>" class="btn btn-success"><i class="fa fa-thumbs-o-up"></i></a>
                    <?php } else { ?>
                    <button type="button" class="btn btn-success" disabled><i class="fa fa-thumbs-o-up"></i></button>
                    <?php } ?>

                    <?php if ($list['disapproved']) { ?>
                    <a href="<?php echo $list['disapproved']; ?>" data-toggle="tooltip" title="<?php echo $button_desapprove; ?>" class="btn btn-danger"><i class="fa fa-thumbs-o-down"></i></a>
                    <?php } else { ?>
                    <button type="button" class="btn btn-danger" disabled><i class="fa fa-thumbs-o-down"></i></button>
                    <?php } ?>
                    
                  </td>
                <?php } ?>
                <?php } else { ?>
                <tr>
                  <td class="text-center" colspan="9"><?php echo $text_no_results; ?></td>
                </tr>
                <?php } ?>
              </tbody>
            </table>
          </div>
        </form>
        <div class="row">
          <div class="col-sm-6 text-left"><?php echo $pagination; ?></div>
          <div class="col-sm-6 text-right"><?php echo $results; ?></div>
        </div>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
$('#button-filter').on('click', function() {
  var url = 'index.php?route=job/job_submit_list&token=<?php echo $token; ?>';
  
  var filter_company_id = $('input[name=\'company_id\']').val();

  if (filter_company_id) {
    url += '&filter_company_id=' + encodeURIComponent(filter_company_id);
  }

  var filter_experience = $('input[name=\'filter_experience\']').val();

  if (filter_experience) {
    url += '&filter_experience=' + encodeURIComponent(filter_experience);
  }
  
  location = url;
});
</script>

<script type="text/javascript">
$('input[name=\'filter_company_id\']').autocomplete({
  'source': function(request, response) {
    $.ajax({
      url: 'index.php?route=job/job_submit_list/autocomplete&token=<?php echo $token; ?>&filter_full_name=' +  encodeURIComponent(request),
      dataType: 'json',
      success: function(json) {
        json.unshift({
          company_id: 0,
          full_name:'<?php echo $text_none; ?>'
        });

        response($.map(json, function(item) {
          return {
            label: item['full_name'],
            value: item['company_id']
          }
        }));
      }
    });
  },
  'select': function(item) {
    $('input[name=\'filter_company_id\']').val(item['label']);
    $('input[name=\'company_id\']').val(item['value']);
  }
});
</script>

<?php echo $footer; ?>