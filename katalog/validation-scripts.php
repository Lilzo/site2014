<script>
    $j(document).ready(function() {
        // validate signup form on keyup and submit
        var validator = $j("#frm-kolicina").validate({
            rules: {
                kolicina: {
                    required: true,
                    digits: true
                }
            },
            messages: {
                kolicina: {
                    required: "Unesite količinu!",
                    digits: "Unesite broj!"
                }

            },
            // set this class to error-labels to indicate valid fields
            success: function(label) {
                // set &nbsp; as text for IE
                label.html("&nbsp;").addClass("checked");
            },
            highlight: function(element, errorClass) {
                $j(element).parent().next().find("." + errorClass).removeClass("checked");
            }
        });
    });
</script>
<script>
    $j(document).ready(function() {
        // validate signup form on keyup and submit
        var validatorZahtjevZaNabavku = $j("#frm-order").validate({
            rules: {
                ime: {
                  
                },
               prezime: {
                
                },
                ulica: {
                    
                },
                grad: {
                   
                },
                postanskibroj: {
                    digits: true
                },
                drzava: {
              
                },
                tel1: {
                 
                },
                tel2: {

                    digits: true
                },
                tel3: {

                    digits: true
                },
                email: {
                    required: true,
                    email:true
                }
            },
            messages: {
                ime: {
                    required: "Popunite polje!"
                },
                 prezime: {
                    required: "Popunite polje!"                   
                },
                ulica: {
                    required: "Popunite polje!"                    
                },
                grad: {
                    required: "Popunite polje!"                    
                },
                drzava: {
                    required: "Popunite polje!", 
                    digits: "Unesite samo brojeve!"
                },
                postanskibroj: {
                    required: "Popunite polje!",
                     digits: "Unesite samo brojeve!"
                },
                tel1: {
                    required: "Popunite polje!"                     
                },
                tel2: {
                    required: "Popunite polje!",
                    digits: "Unesite samo brojeve!"
                },
                tel3: {
                    required: "Popunite polje!",
                    digits: "Unesite samo brojeve!"
                },
                email: {
                    required: "Popunite polje!",
                    email: "Nepravilna email adresa!"
                }
            },
            // set this class to error-labels to indicate valid fields
            success: function(label) {
                // set &nbsp; as text for IE
                label.html("&nbsp;").addClass("checked");
            },
            highlight: function(element, errorClass) {
                $j(element).parent().next().find("." + errorClass).removeClass("checked");
            }
        });
    });
</script>