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
        var i = $('#p_scents p').size() + 1;
        
        $('#addScnt').on('click', function() {
                $('<p><input type="text" placeholder="Nom" name="name_' + i + '" required=""></input> <input type="text" placeholder="Numéro de téléphone" name="phone_' + i + '" required=""></input> <button id="remScnt" class="btn btn-danger btn-xs">Supprimer</button></p>').appendTo(scntDiv);
                i++;
                return false;
        });
        
        $('#remScnt').on('click', function() { 
                if( i > 2 ) {
                        //console.log($(this).parents('p'));
                        scntDiv.remove();
                        i--;
                }
                return false;
        });
});


</script>

</body>

</html>
