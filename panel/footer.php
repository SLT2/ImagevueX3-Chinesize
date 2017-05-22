<?php
if (!isset($core))
{
	require_once 'filemanager_core.php';
	$core = new filemanager_core();
    require_once 'filemanager_language.php';
}
if ($core->isLogin() and $core->role == "admin")
{
?>
    </div> <!-- /container -->

    <div class="container">
    		<hr>
        <div class="footer">
            <p>X3 v<?php echo $x3_config["x3_version"] ?></p>
        </div>
    </div>


<div class="pswp" tabindex="-1" role="dialog" aria-hidden="true">

    <div class="pswp__bg"></div>

    <div class="pswp__scroll-wrap">

        <div class="pswp__container">
            <div class="pswp__item"></div>
            <div class="pswp__item"></div>
            <div class="pswp__item"></div>
        </div>

        <div class="pswp__ui pswp__ui--hidden">

            <div class="pswp__top-bar">

                <div class="pswp__counter"></div>

                <button class="pswp__button pswp__button--close" title="Close (Esc)"></button>

                <button class="pswp__button pswp__button--share" title="Share"></button>

                <button class="pswp__button pswp__button--fs" title="Toggle fullscreen"></button>

                <button class="pswp__button pswp__button--zoom" title="Zoom in/out"></button>

                <div class="pswp__preloader">
                    <div class="pswp__preloader__icn">
                      <div class="pswp__preloader__cut">
                        <div class="pswp__preloader__donut"></div>
                      </div>
                    </div>
                </div>
            </div>

            <div class="pswp__share-modal pswp__share-modal--hidden pswp__single-tap">
                <div class="pswp__share-tooltip"></div> 
            </div>

            <button class="pswp__button pswp__button--arrow--left" title="Previous (arrow left)">
            </button>

            <button class="pswp__button pswp__button--arrow--right" title="Next (arrow right)">
            </button>

            <div class="pswp__caption">
                <div class="pswp__caption__center"></div>
            </div>

        </div>

    </div>

</div>

		<!-- Needs to be included before other JS -->
		<script src="filemanager_js/tmpl.min.js"></script>

		<!-- various JS -->
		<script src='js/jquery.min.js'></script>
		<script src="js/bootstrap.min.js"></script>
		<script src="js/keymaster.min.js"></script>
		<script src="js/autosize.min.js"></script>
		<script src="js/jquery-scrolltofixed-min.js"></script>
		<script src="js/load-image.min.js"></script>
		<script src="js/canvas-toblob.min.js"></script>
		<script src="js/jquery.ui.widget.js"></script>
		<script src="js/jquery.fileupload.js"></script>
		<script src="js/jquery.fileupload-process.js"></script>
		<script src="js/jquery.fileupload-image.js"></script>
		<script src="js/jquery.fileupload-audio.js"></script>
		<script src="js/jquery.fileupload-video.js"></script>
		<script src="js/jquery.fileupload-validate.js"></script>
		<script src="js/jquery.fileupload-ui.js"></script>
		<script src="js/simplemde.min.js"></script>
		<script src="js/underscore-min.js"></script>
		<script src="js/ace.js"></script>
		<script src="js/mode-css.js"></script>
		<script src="js/mode-javascript.js"></script>
		<script src="js/mode-html.js"></script>
		<script src="js/mode-json.js"></script>
		<script src="js/worker-css.js"></script>
		<script src="js/worker-javascript.js"></script>
		<script src="js/worker-html.js"></script>
		<script src="js/worker-json.js"></script>
		<script src="js/theme-tomorrow_night.js"></script>
		<script src="js/jquery.velocity.min.js"></script>
		<script src="js/velocity.ui.min.js"></script>
		<script src="js/photoswipe.min.js"></script>
		<script src="js/photoswipe-ui-default.min.js"></script>
		<script src="js/mode-apache_conf.js"></script>
		<script src="js/apache_conf.js"></script>
		<script src="js/sortable.min.js"></script>

    <!-- Custom script -->
    <script>
    var fileTreeUserFolder = '';
    var cloudflare = <?php if(defined('CLOUDFLARE_ENABLED') && CLOUDFLARE_ENABLED && defined('CLOUDFLARE_EMAIL') && CLOUDFLARE_EMAIL && defined('CLOUDFLARE_KEY') && CLOUDFLARE_KEY) { echo 'true'; } else { echo 'false'; } ?>;
    var custom_setting_templates = <?php echo (file_exists('../config/custom-setting-templates.json') && is_readable('../config/custom-setting-templates.json') ? 'true' : 'false') ?>;
    var user = 'super';
    var hide_auth = <?php if(defined('HIDE_AUTH') && HIDE_AUTH) { echo 'true'; } else { echo 'false'; } ?>;
    </script>

    <!-- X3 Panel -->
    <script src="filemanager_js/x3_panel.js?v=<?php echo $x3_config["x3_panel_version"]; ?>"></script>

    <!-- Here we go -->
   	<script>

   	function initShowFileManager(){
   		<?php
        $key = "redirect_to_url_file_manager_go";
        if(isset($_SESSION[$key]))
        {
            $dir = $_SESSION[$key];
            unset($_SESSION[$key]);
            if(is_dir($dir))
            {
?>
        loading_from_file = false;
        showFileManager('<?php echo addslashes($dir);?>');
<?php
            }
            else
            {
?>
        loading_from_file = false;
        showFileManager('');
<?php
            }
        }
        else
        {
?>
            loading_from_file = false;
            //showFileManager('');
            x3NavPage();
            //x3ShowFileManager();
<?php
        }
?>

   	}


   	$(document).ready(function(){

   		/*$("#homeMenu").click(function()
   		{
            loading_from_file = false;
   			showHomePage();
   		});*/
				
	   $("#editProfile, a.editProfile").click(function()
		{
           loading_from_file = false;
		   showEditProfile();
	   });

	   $("#fileManager").click(function(){
            loading_from_file = false;
            page = 1;
			//showFileManager('');
			x3ShowFileManager();
	   });

       $("#setting").click(function(){
           loading_from_file = false;
           showSetting();
       });

       $("#users").click(function(){
           loading_from_file = false;
           showUsers();
       });

       $("#addUser").click(function(){
           loading_from_file = false;
           showAddUser();
       });

       $("#tickets").click(function(){
           loading_from_file = false;
           showTickets();
       });

	   
	 });


    function show_ticket(id)
    {
        if(typeof (show_what) == 'undefined')
        {
            show_what = "all";
        }

        if(typeof (ticket_page) == 'undefined')
        {
            ticket_page = 1;
        }
       $('#preloader').modal('show');
       $.post("ajax_ticket_show.php",
       {
           showTicket:<?php echo $core->admin_id;?>,
           show_what:show_what,
           ticket_page:ticket_page,
           ticketId:id
       },
       function(data,status)
       {
           if(status == "success")
           {
               $('#content_show').html('');
               $('.bar').addClass('bar-success');
               $('.navbar-nav > li').removeClass('active');
               $('#tickets').addClass('active');
               $("#preloader").modal("hide");
               $('#content_show').fadeIn(1000);
               $('#content_show').html(data);
           }
           else
           {
               $('.bar').width("30%");
               $('.bar').width("50%");
               $('.bar').width("80%");
               $('.bar').width("100%");
               $('.bar').addClass('bar-danger');
               $('.bar').html("<center>Can not load page, click to exit. SERVER STATUS: "+status+"</center>");
           }
       });
    }

    function showTickets()
    {
        if(typeof (show_what) == 'undefined')
        {
            show_what = "all";
        }

        if(typeof (ticket_page) == 'undefined')
        {
            ticket_page = 1;
        }
       $('#preloader').modal('show');
       $.post("ajax_tickets_show.php",
       {
           showTickets:<?php echo $core->admin_id;?>,
           show_what:show_what,
           ticket_page:ticket_page
       },
       function(data,status)
       {
           if(status == "success")
           {
               $('#content_show').html('');
               $('.bar').addClass('bar-success');
               $('.navbar-nav > li').removeClass('active');
               $('#tickets').addClass('active');
               $("#preloader").modal("hide");
               $('#content_show').fadeIn(1000);
               $('#content_show').html(data);
           }
           else
           {
               $('.bar').width("30%");
               $('.bar').width("50%");
               $('.bar').width("80%");
               $('.bar').width("100%");
               $('.bar').addClass('bar-danger');
               $('.bar').html("<center>Can not load page, click to exit. SERVER STATUS: "+status+"</center>");
           }
       });
    }

    function showAddUser()
    {
       $('#preloader').modal('show');
       $.post("ajax_add_user.php",
       {
           showAddUser:<?php echo $core->admin_id;?>
       },
       function(data,status)
       {
           if(status == "success")
           {
               $('#content_show').html('');
               $('.bar').addClass('bar-success');
               $('.navbar-nav > li').removeClass('active');
               $('#users').addClass('active');
               $("#preloader").modal("hide");
               $('#content_show').fadeIn(1000);
               $('#content_show').html(data);
           }
           else
           {
               $('.bar').width("30%");
               $('.bar').width("50%");
               $('.bar').width("80%");
               $('.bar').width("100%");
               $('.bar').addClass('bar-danger');
               $('.bar').html("<center>Can not load page, click to exit. SERVER STATUS: "+status+"</center>");
           }
       });
    }

	function showHomePage()
	{
		$('#preloader').modal('show');
		 $.post("ajax_show_home.php",
		{
			showHome:<?php echo $core->admin_id;?>
		},
		function(data,status)
		{
			if(status == "success")
			{
				$('#content_show').html('');
				$('.bar').addClass('bar-success');
				$('.navbar-nav > li').removeClass('active');
				$('#homeMenu').addClass('active');
				$("#preloader").modal("hide");
				$('#content_show').fadeIn(1000);
				$('#content_show').html(data);
			}
			else
			{
				$('.bar').width("30%");
				$('.bar').width("50%");
				$('.bar').width("80%");
				$('.bar').width("100%");
				$('.bar').addClass('bar-danger');
				$('.bar').html("<center>Can not load page, click to exit. SERVER STATUS: "+status+"</center>");
			}
			       
		});
	}

    function showUsers()
    {
        $('#preloader').modal('show');
        $.post("ajax_show_users.php",
        {
            showUser:<?php echo $core->admin_id;?>
        },
        function(data,status)
        {
            if(status == "success")
            {
                $('#content_show').html('');
                $('.bar').addClass('bar-success');
                $('.navbar-nav > li').removeClass('active');
                $('#users').addClass('active');
                $("#preloader").modal("hide");
                $('#content_show').fadeIn(1000);
                $('#content_show').html(data);
            }
            else
            {
                $('.bar').width("30%");
                $('.bar').width("50%");
                $('.bar').width("80%");
                $('.bar').width("100%");
                $('.bar').addClass('bar-danger');
                $('.bar').html("<center>Can not load page, click to exit. SERVER STATUS: "+status+"</center>");
            }
        });
    }

    function showSetting()
    {
        $('#preloader').modal('show');
        $.post("ajax_show_setting.php",
        {
            showSetting:<?php echo $core->admin_id;?>
        },
        function(data,status)
        {
            if(status == "success")
            {
                $('#content_show').html('');
                $('.bar').addClass('bar-success');
                $('.navbar-nav > li').removeClass('active');
                $('#setting').addClass('active');
                $("#preloader").modal("hide");
                $('#content_show').fadeIn(1000);
                $('#content_show').html(data);
            }
            else
            {
                $('.bar').width("30%");
                $('.bar').width("50%");
                $('.bar').width("80%");
                $('.bar').width("100%");
                $('.bar').addClass('bar-danger');
                $('.bar').html("<center>Can not load page, click to exit. SERVER STATUS: "+status+"</center>");
            }

        });
    }
   	
	 function showEditProfile()
	 {
		 $('#preloader').modal('show');
	     $.post("ajax_show_profile.php",
	     {
	      	showProfile:<?php echo $core->admin_id;?>
	     },
	     function(data,status)
	     {
		     if(status == "success")
		     {
		    	$('#content_show').html('');
		     	$('.bar').addClass('bar-success');
			    $('.navbar-nav > li').removeClass('active');
		    	$('#editProfile').addClass('active');
		    	$("#preloader").modal("hide");
		    	$('#content_show').fadeIn(1000);
		    	$('#content_show').html(data);
		     }
		     else
		     {
		    	 $('.bar').width("30%");
		    	 $('.bar').width("50%");
			     $('.bar').width("80%");
			     $('.bar').width("100%");
		    	 $('.bar').addClass('bar-danger');
		    	 $('.bar').html("<center>Can not load page, click to exit. SERVER STATUS: "+status+"</center>");
		     }
	       
	     });
	 }

     reload_sidebar = false;
     first_flag = true;
	 function showFileManager(dir_path)
	 {

		 if(typeof (my_sort) == 'undefined')
		 {
			 my_sort = "name";
		 }

         if(typeof (loading_from_file_status) == 'undefined')
         {
             loading_from_file_status = "blue";
         }

         if(typeof (page) == 'undefined')
         {
             page = 1;
         }

         if(typeof (countShow) == 'undefined')
         {
             countShow = 10;
         }

         if(typeof (search) == 'undefined')
         {
             search = '';
         }

         if(typeof (have_action) == 'undefined')
         {
             have_action = 'no';
         }
		 
		 if(dir_path == "" || dir_path == "<?php echo ROOT_DIR_NAME;?>")
		 {
			var set_root = 1;
		 }
		 else
		 {
			var set_root = 0;
		 }
         if(loading_from_file == false)
		    $('#preloader').modal('show');

		  	// x3 before show file manager
        x3BeforeShowFileManager();

	     $.post("ajax_show_filemanager.php",
	     {
	    	 showFilemanager:<?php echo $core->admin_id;?>,
    	   	 root:set_root,
    	   	 my_dir_path:dir_path,
    	   	 sort_type:my_sort,
             page:page,
             countShow:countShow,
             have_action:have_action,
             search:search
	     },
	     function(data,status)
	     {
		     if(status == "success")
		     {

		     	if(first_flag !== true && $("#show_left_sidebar").length > 0) first_flag = $("#show_left_sidebar").html();

		    	$('#content_show').html('');
		     	$('.bar').addClass('bar-success');
			    $('.navbar-nav > li').removeClass('active');
		    	$('#fileManager').addClass('active');
		    	if(loading_from_file == false)
                {
                    $("#preloader").modal("hide");
                }
                else
                {
                    show_errors_on_nav(loading_from_file, loading_from_file_status);
                }
                loading_from_file = false;
                search = '';
                have_action = "no";
		    	$('#content_show').fadeIn(1000);
		    	$('#content_show').html(data);
                if( !reload_sidebar ) {
                    //$(".jqueryFileTree > li").addClass("directory collapsed directory_hover");
                    if(first_flag == true) {
                      $("#left_folder_menu_box").appendTo("#show_left_sidebar");
                      first_flag = $("#show_left_sidebar").html();
                      /*setTimeout(function(){
                      	first_flag = $("#show_left_sidebar").html();
                      }, 2000);*/
                    }
                    else {
                      $("#show_left_sidebar").html(first_flag);
                      updateMtree();
                    }
                }
                else {
                    show_left_folder_menu();
                }
                lick = true;

                // X3 after show file manager
                x3AfterShowFileManager(dir_path);
		     }
		     else
		     {
                 lick = true;
		    	 $('.bar').width("30%");
		    	 $('.bar').width("50%");
			     $('.bar').width("80%");
			     $('.bar').width("100%");
		    	 $('.bar').addClass('bar-danger');
		    	 $('.bar').html("<center>Can not load page, click to exit. SERVER STATUS: "+status+"</center>");		    	 
		     }
	     });
	 }

    here = '';
    function show_left_folder_menu()
    {
       if( !reload_sidebar ) {

           $('#show_left_sidebar').html('Please wait...');


           // X3 menu from localstorage if unchanged
           /*var mtime = '<?php echo filemtime(ROOT_DIR_NAME); ?>';
           if(supports_local_storage() && 
           		localStorage.getItem('mtree_saved') !== null &&
           		localStorage.getItem('mtree_mtime') !== null &&
           		localStorage.getItem('mtree_mtime') == mtime){
           		$('#show_left_sidebar').html('');
           		$('#left_folder_menu_box').html(localStorage.getItem('mtree_saved'));
           		setTimeout(function(){createMtree()}, 1);
           		console.log('LOCALSTORAGE ');
           } else {
           	$('#left_folder_menu_box').load('x3_menu.php', {dir:'<?php echo ROOT_DIR_NAME;?>/'}, function() {
           		$('#show_left_sidebar').html('');
           		createMtree();
						});
						console.log('RELOAD ');
           }
           if(supports_local_storage()) localStorage.setItem('mtree_mtime', mtime);*/
           
           	$('#left_folder_menu_box').load('x3_menu.php', {dir:'<?php echo ROOT_DIR_NAME;?>/'}, function(data) {
           		$('#show_left_sidebar').html('');
           		createMtree();
           		$(function() {
           			initShowFileManager();
							});
						});

           /*$('#left_folder_menu_box').leftFileTree({
               root: '<?php echo ROOT_DIR_NAME;?>/',
               script: 'folderMenu.php',
               expandSpeed: 100,
               collapseSpeed: 100,
               multiFolder: false
           }, function(file) {

           });*/

       }
       else {
           reload_sidebar = false;
           $("#left_folder_menu_box").remove();
           $("#left_sidebar").html('<div id="left_folder_menu_box"></div>');
           $('#show_left_sidebar').html('Please wait...');

           $('#left_folder_menu_box').load('x3_menu.php', {dir:'<?php echo ROOT_DIR_NAME;?>/'}, function() {
           		$('#show_left_sidebar').html('');
           		$("#left_folder_menu_box").appendTo("#show_left_sidebar");
           		createMtree();
           		first_flag = $("#show_left_sidebar").html();
						});

           /*$('#left_folder_menu_box').fileTree({
               root: '<?php echo ROOT_DIR_NAME;?>/',
               script: 'folderMenu.php',
               expandSpeed: 100,
               collapseSpeed: 100,
               multiFolder: false
           }, function(file) {

           });*/

           /*setTimeout(function(){
               $('#show_left_sidebar').html('');
               $("#left_folder_menu_box").appendTo("#show_left_sidebar");
               first_flag = $("#show_left_sidebar").html();
               open_folders = new Array();
               open_all_dirs( fileTreeUserFolder );
           }, 1000);*/
       }
    }
    show_left_folder_menu();


    function show_errors_on_nav(msg, color)
    {
        if(color == "red")
        {
            color = "#D9534F";
        }

        if(color == "green")
        {
            color = "#5CB85C";
        }

        if(color == "blue")
        {
            color = "#428BCA";
        }

        $("html, body").animate({ scrollTop: 0 }, "slow");
        $("#welcome").attr("data-content", "<center><span style='color: "+color+";'>"+msg+"</span></center>");
        $('#welcome').popover('show');
        setTimeout(function(){$('#welcome').popover('hide');}, 3000);
    }

    function show_preloader()
    {
        $("html, body").animate({ scrollTop: 0 }, "slow");
        $("#welcome").attr("data-content", "<center><img src='filemanager_assets/img.php?img=preloader'/></center>");
        $('#welcome').popover('show');
    }

    function hide_preloader()
    {
        $("html, body").animate({ scrollTop: 0 }, "slow");
        $("#welcome").attr("data-content", "");
        $('#welcome').popover('hide');
    }

    <?php echo "var language = ". json_encode($language) . ";\n"; ?>

   </script>

  </body>
</html>

<?php 
}
else
{
	header("Location: .");
}
?>
