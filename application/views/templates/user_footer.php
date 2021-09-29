           <footer class="main-footer">
               <div class="footer-right">
                   Copyright &copy; Your Website <?= date('Y'); ?>
               </div>
           </footer>
           </div>
           </div>

           <!-- General JS Scripts -->

           <!-- <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script> -->
           <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
           <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
           
           <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
           <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.nicescroll/3.7.6/jquery.nicescroll.min.js"></script>
           <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
           <script src="<?= base_url(); ?>assets/js/sweetalert2.all.min.js"></script>
           <script src="<?= base_url(); ?>assets/js/myscripts.js"></script>


           <script src="<?= base_url(); ?>assets/js/stisla.js"></script>
           <script src="<?= base_url(); ?>assets/js/stisla.js"></script>

           <!-- Template JS File -->
           <script src="<?= base_url(); ?>assets/js/scripts.js"></script>
           <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
           <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
           <script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
           <script src="https://cdn.datatables.net/responsive/2.2.9/js/responsive.bootstrap4.min.js"></script>


           <!-- <script src="https://cdn.datatables.net/buttons/2.0.0/js/buttons.html5.min.js"></script>
            <script src="https://cdn.datatables.net/buttons/2.0.0/js/buttons.print.min.js"></script>
            <script src="https://cdn.datatables.net/buttons/2.0.0/js/buttons.colVis.min.js"></script> -->

           <script src="<?= base_url(); ?>assets/js/page/index-0.js"></script>


           <script>
               $(document).ready(function() {
                   var table = $('#datatables').DataTable({
                       "lengthMenu": [
                           [10, 25, 50, -1],
                           ["10", "25 ", "50 ", "All"]
                       ],
                       language: {
                           search: "Cari :"
                       },

                   });


                   //  table.buttons().container()
                   // .appendTo( '#datatables_wrapper .col-md-6:eq(0)' );
               });
           </script>

           </body>

           </html>