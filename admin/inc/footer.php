            </div>
            <!-- End of Main Content -->
            <div class="clear">

            </div>
            <div class="clear">
            </div>
        </div>
    <!-- End of Content Wrapper -->
    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="?action=logout">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.js"></script>

    <script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            statistical();
            let char = new Morris.Area({
                element: 'myfirstchart',

                xkey: 'date',

                ykeys: ['order', 'salary', 'quantity'],

                labels: ['Order', 'Salary', 'Quantity']
            });
            $('.select-date').onchange(function () {
                let time = $(this).val();
                if(time == '7days'){
                    var text = 'Last 7 days';
                } else if (time == '28days'){
                    var text = 'Last 28 days';
                } else if (time == '90days'){
                    var text = 'Last 90 days';
                } else {
                    var text = 'Last 365 days';
                }
                $.ajax({
                    url:"../admin/statistical.php",
                    method:"POST",
                    dataType:"JSON",
                    data:{time:time},
                    success:function(data){
                        char.setData(data);
                        $('#text-date').text(text);
                    }
                });
            })
            function statistical() {
                let text = 'Last 7 days';
                $('#text-date').text(text);
                $.ajax({
                    url:"../admin/statistical.php",
                    method:"POST",
                    dataType:"JSON",
                    success:function(data){
                        char.setData(data);
                        $('#text-date').text(text);
                    }
                });
            }
        });
    </script>
</body>

</html>