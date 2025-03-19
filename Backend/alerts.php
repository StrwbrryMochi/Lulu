<?php

if (isset($_GET['welcome']) && $_GET['welcome'] == 'true') {
    $profilePhoto = $Photo;  
    
    echo "<script>
            setTimeout(function() {
            var username = '" . $FirstName . "';
            var profilePhoto = '" . $Photo . "'; 

            Swal.fire({
                position: 'top',
                title: '<span style=\"color: white;\">Welcome, </span><span style=\"color:rgb(134, 134, 201); margin: 0 5px;\">' + username + '</span><span style=\"color: white;\">!</span>',
                showConfirmButton: false,
                timer:500,
                html: '<img src=\"' + profilePhoto + '\" style=\"width: 100px; height: 100px; border-radius: 50%; object-fit: cover;\">',
                background: 'rgb(18,21,31,255)',
            });
        }, 5000); 
    </script>";
}
