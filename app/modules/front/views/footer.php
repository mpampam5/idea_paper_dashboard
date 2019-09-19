
</div>
<!-- container-scroller -->

<!-- plugins:js -->
<!-- modal -->
<div class="modal fade" id="modalGue" tabindex="-1" role="dialog"  aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modalTitle"></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
        </div>
        <div class="modal-body" id="modalContent" style="max-height: 487px; overflow-y: auto;"></div>
        <div  id="modalFooter"></div>
      </div>
    </div>
</div>
<!-- end model -->
<!-- endinject -->
<!-- End plugin js for this page -->
<!-- inject:js -->
<script src="<?=base_url()?>_template/front/vendors/owl-carousel-2/owl.carousel.min.js"></script>
<script src="<?=base_url()?>_template/front/js/off-canvas.js"></script>
<script src="<?=base_url()?>_template/front/js/hoverable-collapse.js"></script>
<script src="<?=base_url()?>_template/front/js/template.js"></script>
<script src="<?=base_url()?>_template/front/js/settings.js"></script>
<script src="<?=base_url()?>_template/front/js/todolist.js"></script>
<!-- endinject -->
<!-- Custom js for this page-->
<script src="<?=base_url()?>_template/front/js/dashboard.js"></script>
<script src="<?=base_url()?>_template/front/js/owl-carousel.js"></script>
<!-- End custom js for this page-->


<script type="text/javascript">

$(document).ready(function(){
  $('#modalGue').on('hide.bs.modal', function () {
			setTimeout(function(){
					$('#modalTitle, #modalContent').html('');
				}, 500);
	   });
});



</script>


</body>



</html>
