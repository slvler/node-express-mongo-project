<?php $this->load->view('admin/layout/header'); ?>
<?php $this->load->view('admin/layout/top'); ?>
<?php $this->load->view('admin/layout/leftside'); ?>
<link rel="stylesheet" href="assets/plugins/dropzonejs/dropzone.min.css">
<style>
    .dz-success-mark, .dz-error-mark {
        display: none;
    }

    #file_uploader {
        min-height: 200px;
        border: 2px dashed #0087F7;
        border-radius: 5px;
        background: white;
        display: flex;
    }
    #file_uploader {
        cursor: pointer;
    }
    #file_uploader .info {
        align-self: center;
        font-size: 1.4rem;
        color: #A0D4FF;
        width: 100%;
        text-align: center;
    }
    #file_uploader.dz-started .info {
        display: none;
    }
    .dz-preview {
        display: inline-block;
        width: 15%;
        border: 1px solid;
        border-radius: 5px;
        margin: 5px;
        padding: 0 15px;
        text-align: center;
    }
    .dz-button {
        border: none;
        background: none;
    }
    .dz-preview.dz-success .dz-success-mark, .dz-preview.dz-error .dz-error-mark {
        display: block;
    }
    .dz-success-mark path {
        fill: green;
    }
    .dz-error-mark path {
        fill: #ac0000;
    }

    @media (max-width:587px) {
        .dz-preview {
            display: block;
            width: 100%;
        }
    }
    
</style>
	<div class="row heading-bg">
		<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
			<h5 class="txt-dark">FileZilla'dan İçe Aktar</h5>
		</div>
		<div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
			<a href="<?php echo site_url('password_manager/admin/add_record/'.(int)($this->uri->segment(4))); ?>" class="btn btn-primary btn-xs pull-right">Yeni Hesap Ekle</a>
		</div>
	</div>
	<?php if (!empty ($this->session->flashdata('success_message'))): ?>
		<div class="alert alert-success alert-dismissable">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
			<i class="zmdi zmdi-check pr-15 pull-left"></i><p class="pull-left"><?php echo $this->session->flashdata('success_message'); ?></p> 
			<div class="clearfix"></div>
		</div>
	<?php endif; ?>
	<div class="row">
		<div class="col-sm-12">
            <div class="panel panel-default card-view">
                <div class="panel-wrapper collapse in">
                    <div class="panel-body">
                        <div id="file_uploader">
                            <div class="info dz-message needsclick">
                                <button class="dz-button">
                                İçe aktarılacak şifre çıktı dosyasını sürükleyip bırakın ya da seçmek için buraya tıklayın
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
		</div>
	</div>
	
<?php $this->load->view('admin/layout/footer'); ?>
<?php $this->load->view('admin/layout/end'); ?>
<script src="assets/plugins/dropzonejs/dropzone.min.js"></script>
<script>    
    Dropzone.autoDiscover = false;
    $(function() {
        // Now that the DOM is fully loaded, create the dropzone, and setup the
        // event listeners
        var myDropzone = new Dropzone("div#file_uploader", {
            url: "<?=site_url('password_manager/admin/filezilla_import')?>",
            paramName: "file", // The name that will be used to transfer the file
            maxFilesize: 2, // MB
            createImageThumbnails: false,
            acceptedFiles:".xml"
        });
    });
</script>