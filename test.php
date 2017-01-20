<!-- Use a JQuery ThemeRoller theme, in this case 'smoothness' -->
<link rel="stylesheet" type="text/css" href="/styles/css/dropdownchecklist/smoothness-1.8.13/jquery-ui-1.8.13.custom.css">
<link rel="stylesheet" type="text/css" href="/styles/css/dropdownchecklist/ui.dropdownchecklist.themeroller.css">
<!--  <link rel="stylesheet" type="text/css" href="../src/ui.dropdownchecklist.standalone.css">  -->

<!-- Include the basic JQuery support (core and ui)-->
<script type="text/javascript" src="/styles/js/dropdownchecklist/jquery-1.6.1.min.js"></script>
<script type="text/javascript" src="/styles/js/dropdownchecklist/jquery-ui-1.8.13.custom.min.js"></script>

<!-- Include the DropDownCheckList supoprt -->
<!-- <script type="text/javascript" src="ui.dropdownchecklist.js"></script> -->
<script type="text/javascript" src="/styles/js/dropdownchecklist/ui.dropdownchecklist-1.4-min.js"></script>

<script type="text/javascript">
    $(document).ready(function() {
        $("#s1").dropdownchecklist();
        $("#s2").dropdownchecklist( {icon: {}, width: 150 } );
        $("#s3").dropdownchecklist( { width: 150 } );
        $("#s4").dropdownchecklist( { maxDropHeight: 150 } );
        $("#s5").dropdownchecklist( { firstItemChecksAll: true, explicitClose: '...close' } );
        $("#s6").dropdownchecklist();
        $("#s7").dropdownchecklist();
        $("#s8").dropdownchecklist( { emptyText: "Please Select...", width: 150 } );
        $("#s9").dropdownchecklist( { textFormatFunction: function(options) {
            var selectedOptions = options.filter(":selected");
            var countOfSelected = selectedOptions.size();
            switch(countOfSelected) {
                case 0: return "<i>Nobody<i>";
                case 1: return selectedOptions.text();
                case options.size(): return "<b>Everybody</b>";
                default: return countOfSelected + " People";
            }
        } });
        $("#s10").dropdownchecklist( { forceMultiple: true
            , onComplete: function(selector) {
                var values = "";
                for( i=0; i < selector.options.length; i++ ) {
                    if (selector.options[i].selected && (selector.options[i].value != "")) {
                        if ( values != "" ) values += ";";
                        values += selector.options[i].value;
                    }
                }
                alert( values );
            }
            , onItemClick: function(checkbox, selector){
                var justChecked = checkbox.prop("checked");
                var checkCount = (justChecked) ? 1 : -1;
                for( i = 0; i < selector.options.length; i++ ){
                    if ( selector.options[i].selected ) checkCount += 1;
                }
                if ( checkCount > 3 ) {
                    alert( "Limit is 3" );
                    throw "too many";
                }
            }
        });
    });
</script>
<select id="s1" multiple="multiple">
    <option>Low</option>
    <option>Medium</option>
    <option>High</option>
</select>