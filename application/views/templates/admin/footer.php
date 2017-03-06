<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');   ?>
		
		<footer class="main-footer">
			<div class="pull-right hidden-xs">
				<b>Version</b> 1.0
			</div>
			<strong>Copyright &copy; 2017 <a target="_blank" href="http://ubig.co.id">UBIG</a>.</strong> All rights
			reserved | Developed by <strong>ndasoft</strong>
		</footer>

	</div>
	<!-- ./wrapper -->

<?php  
	$array_js = array(
		'bootstrap.min.js',
		'fastclick.js',
		'app.min.js',
		'jquery.sparkline.min.js',
		'jquery-jvectormap-1.2.2.min.js',
		'jquery-jvectormap-world-mill-en.js',
		'jquery.slimscroll.min.js',
		'Chart.min.js',
		'demo.js',
		'jquery.dataTables.min.js',
		'dataTables.bootstrap.min.js',
		'bootstrap-formhelpers.js', 
		'nprogress.js'
	);

	echo "\n\t";

	foreach($array_js as $val)
		echo js_asset('', $val);
?>

<?php 
	if($this->uri->segment(2) == 'members'){
		?>
	<script type="text/javascript">
	  	$('#example2').DataTable({
	      	autoWidth		: true,
	      	responsive		: true,
	      	lengthMenu		: [5, 10, 15, 20]
		});
	</script>
		<?php
	}

	if($this->uri->segment(2) == 'api'){
		?>
	<script type="text/javascript">
	  	$('#data_api').DataTable({
		});
	</script>
		<?php
	}

	if($this->uri->segment(2) == 'orders'){
		?>
	<script type="text/javascript">
		$(document).ready(function() {
			 $.ajaxSetup({
		        data: {
		            '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>'
		        }
		    });
		 
		    //datatables
		    table = $('#data_order').DataTable({ 
		 
		        "processing": true, //Feature control the processing indicator.
		        "serverSide": true, //Feature control DataTables' server-side processing mode.
		        "order": [], //Initial no order.
		 
		        // Load data for the table's content from an Ajax source
		        "ajax": {
		            "url": "<?php echo site_url('admin_controller/ajax_list_orders')?>",
		            "type": "POST"
		        },
		 
		        //Set column definition initialisation properties.
		        "columnDefs": [
		        { 
		            "targets": [ -1 ], //last column
		            "orderable": false, //set not orderable
		        }
		        ]
		    });
		 
		});

		function checkout_api(id) {
			if(confirm('Are you sure to checkout an API?'))
			    {
			        // ajax delete data to database
			        $.ajax({
			            url : "<?php echo site_url('admin_controller/checkout_api')?>/"+id,
			            type: "POST",
			            dataType: "JSON",
			            success: function(data)
			            {
		                	table.ajax.reload(null,false); ;
			            },
			            error: function (jqXHR, textStatus, errorThrown)
			            {
			                alert('Error checkout API');
			            }
			        });
			 
			    }
		}
	</script>
		<?php
	}

	if ($this->uri->segment(2) == 'setting') {
        ?>
        <script type="text/javascript">
            setTimeout(function() {
                $('.alert').fadeOut(1000)
                },
                1000
            )
        </script>

        <script type="text/javascript">
        	$(document).ready(function() {
				$.ajaxSetup({
			        data: {
			            '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>'
			        }
			    });
			 
			    //datatables
			    table = $('#logs').DataTable({ 
			 
			        "processing": true, //Feature control the processing indicator.
			        "serverSide": true, //Feature control DataTables' server-side processing mode.
			        "order": [], //Initial no order.
			 
			        // Load data for the table's content from an Ajax source
			        "ajax": {
			            "url": "<?php echo site_url('admin_controller/ajax_list_logs/')?>",
			            "type": "POST"
			        },
			        "responsive": true,
			 
			        //Set column definition initialisation properties.
			        "columnDefs": [
			        { 
			            "targets": [ -1 ], //last column
			            "orderable": false, //set not orderable
			        },
			        ],
			         "language": {
				      "emptyTable": "No logs found"
				    }
			 
			    });
			 
			});

        	function reload_table()
			{
			    table.ajax.reload(null,false); //reload datatable ajax 
			}

			function clear_logs()
			{
			    if(confirm('Are you sure delete all log?'))
			    {
			        // ajax delete data to database
			        $.ajax({
			            url : "<?php echo site_url('admin_controller/ajax_delete_logs/')?>",
			            type: "POST",
			            dataType: "JSON",
			            success: function(data)
			            {
			                //if success reload ajax table
			                reload_table();
			            },
			            error: function (jqXHR, textStatus, errorThrown)
			            {
			                alert('Error deleting logs data');
			            }
			        });
			 
			    }
			}

			setInterval(function(){
			    reload_table() // this will run after every 5 seconds
			}, 60000);
        </script>

        <?php
    }

    if ($this->uri->segment(2) == 'admin') {
        ?>
        <script type="text/javascript">
            var save_method; //for save method string
			var table;
			 
			$(document).ready(function() {
				 $.ajaxSetup({
			        data: {
			            '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>'
			        }
			    });
			 
			    //datatables
			    table = $('#example2').DataTable({ 
			 
			        "processing": true, //Feature control the processing indicator.
			        "serverSide": true, //Feature control DataTables' server-side processing mode.
			        "order": [], //Initial no order.
			 
			        // Load data for the table's content from an Ajax source
			        "ajax": {
			            "url": "<?php echo site_url('admin_controller/ajax_list/')?>",
			            "type": "POST"
			        },
			 
			        //Set column definition initialisation properties.
			        "columnDefs": [
			        { 
			            "targets": [ -1 ], //last column
			            "orderable": false, //set not orderable
			        },
			        ],
			 
			    });
			 
			});
			 
			function add_person()
			{
			    save_method = 'add';
			    $('#form')[0].reset(); // reset form on modals
			    $('.form-group').removeClass('has-error'); // clear error class
			    $('.help-block').empty(); // clear error string
			    $('#modal_form').modal('show'); // show bootstrap modal
			    $('.modal-title').text('Add Admin'); // Set Title to Bootstrap modal title
			}
			 
			function edit_person(id)
			{
			    save_method = 'update';
			    $('#form')[0].reset(); // reset form on modals
			    $('.form-group').removeClass('has-error'); // clear error class
			    $('.help-block').empty(); // clear error string
			 
			    //Ajax Load data from ajax
			    $.ajax({
			        url : "<?php echo site_url('admin_controller/ajax_edit/')?>/" + id,
			        type: "GET",
			        dataType: "JSON",
			        success: function(data)
			        {
			 			$('<input>').attr({
						    type: 'hidden',
						    name: 'id',
						    value: id
						}).appendTo('form');
			            $('[name="name"]').val(data.name);
			            $('[name="email"]').val(data.email);
			            $('[name="phone"]').val(data.phone);
			            $('[name="address"]').val(data.address);
			            $('[name="password"]').val(data.password);
			            $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
			            $('.modal-title').text('Edit Admin'); // Set title to Bootstrap modal title
			 
			        },
			        error: function (jqXHR, textStatus, errorThrown)
			        {
			            alert('Error get data from ajax');
			        }
			    });
			}
			 
			function reload_table()
			{
			    table.ajax.reload(null,false); //reload datatable ajax 
			}
			 
			function save()
			{
			    $('#btnSave').text('saving...'); //change button text
			    $('#btnSave').attr('disabled',true); //set button disable 
			    var url;
			 
			    if(save_method == 'add') {
			        url = "<?php echo site_url('admin_controller/ajax_add/')?>";
			    } else {
			        url = "<?php echo site_url('admin_controller/ajax_update/')?>";
			    }
			 
			    // ajax adding data to database
			    $.ajax({
			        url : url,
			        type: "POST",
			        data: $('#form').serialize(),
			        dataType: "JSON",
			        success: function(data)
			        {
			 
			            if(data.status) //if success close modal and reload ajax table
			            {
			                $('#modal_form').modal('hide');
			                reload_table();
			            }
			 
			            $('#btnSave').text('save'); //change button text
			            $('#btnSave').attr('disabled',false); //set button enable 
			 
			 
			        },
			        error: function (jqXHR, textStatus, errorThrown)
			        {
			            alert('Error adding / update data');
			            $('#btnSave').text('save'); //change button text
			            $('#btnSave').attr('disabled',false); //set button enable 
			 
			        }
			    });
			}
			 
			function delete_person(id)
			{
			    if(confirm('Are you sure delete this data?'))
			    {
			        // ajax delete data to database
			        $.ajax({
			            url : "<?php echo site_url('admin_controller/ajax_delete')?>/"+id,
			            type: "POST",
			            dataType: "JSON",
			            success: function(data)
			            {
			                //if success reload ajax table
			                $('#modal_form').modal('hide');
			                reload_table();
			            },
			            error: function (jqXHR, textStatus, errorThrown)
			            {
			                alert('Error deleting data');
			            }
			        });
			 
			    }
			}
        </script>

        <?php
    }
?>

	<script type="text/javascript">
	  	$('body').show();
	    NProgress.start();
	    setTimeout(function() { NProgress.done(); $('.fade').removeClass('out'); }, 400);
	</script>

</body>
</html>