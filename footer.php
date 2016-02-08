        </div>
        <div class="footer">
            <div class="pull-right">
                <strong>Copyright</strong> MP Gazelles &copy; 2016
            </div>
        </div>

        </div>
        </div>



    <!-- Mainly scripts -->
    <script src="js/jquery-2.1.1.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/plugins/metisMenu/jquery.metisMenu.js"></script>
    <script src="js/plugins/slimscroll/jquery.slimscroll.min.js"></script>

    <!-- Custom and plugin javascript -->
    <script src="js/inspinia.js"></script>

    <!-- Page-Level Scripts -->
<script type="text/javascript">
  
$(function() {
        var scntDiv = $('#p_scents');
        var i = $('#p_scents li').size() + 1;
        
        $('#addScnt').on('click', function() {
                $('<input type="text" placeholder="Maman" name="name_' + i + '" required=""></input><input type="text" placeholder="0698979695" name="phone_' + i + '" required=""></input> <a href="#" class="btn btn-warning btn-xs">Editer</a> <button id="remScnt" class="btn btn-danger btn-xs">Supprimer</button><br />').appendTo(scntDiv);
                i++;
                return false;
        });
        
        $('#remScnt').on('click', function() { 
                if( i > 2 ) {
                        $(this).parents('li').remove();
                        i--;
                }
                return false;
        });
});


</script>

</body>

</html>
