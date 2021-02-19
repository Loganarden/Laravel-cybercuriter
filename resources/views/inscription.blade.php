@extends('layout')

<style>

#barre {
    background-color: red;
    width: 0;
    height: 10px;
}


</style>
    
@section ('contenu')

    <div>
        Inscription
    </div>

    <div>
        <fieldset>
            <form action="api/inscription" method="post">
            {{ csrf_field() }}

                <p><input type="text" name="name" id="name" placeholder="Nom"></p>
                    @if($errors->has('name'))
                    <p>{{ $errors->first ('name') }}</p>
                    @endif

                <p><input type="text" name="firstname" id="firstname" placeholder="Prenom"></p>
                    @if($errors->has('firstname'))
                    <p>{{ $errors->first ('firstname') }}</p>
                    @endif

                
                <p><input type="email" name="email" id="email" placeholder="Email"></p>
                    @if($errors->has('email'))
                    <p>{{ $errors->first ('email') }}</p>
                    @endif

                <p><input type="password" name="password" id="password" placeholder="Mot de passe"></p>
                    @if($errors->has('password'))
                    <p>{{ $errors->first ('password') }}</p>
                    @endif
                <p>
                <div id="barre"></div>
                <div id="passwordStrength"></div></p>  
    

                <p><input type="password" name="password_confirmation" id="password_confirmation" placeholder="Mot de passe"></p>
                    @if($errors->has('password_confirmation'))
                    <p>{{ $errors->first ('password_confirmation') }}</p>
                    @endif

                <p><input type="submit" value="M'inscrire"></p>
            </form>
        </fieldset>
    </div>

    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script>
    $(document).ready(function() {

$('#password, #password_confirmation').on('keyup', function(e) {

    if($('#password').val() != '' && $('#password_confirmation').val() != '' && $('#password').val() != $('#password_confirmation').val())
    {
        $('#passwordStrength').removeClass().addClass('alert alert-error').html('Passwords do not match!');

        return false;
    }

    // Must have capital letter, numbers and lowercase letters
    var strongRegex = new RegExp("^(?=.{8,})(?=.*[A-Z])(?=.*[a-z])(?=.*[0-9])(?=.*\\W).*$", "g");

    // Must have either capitals and lowercase letters or lowercase and numbers
    var mediumRegex = new RegExp("^(?=.{7,})(((?=.*[A-Z])(?=.*[a-z]))|((?=.*[A-Z])(?=.*[0-9]))|((?=.*[a-z])(?=.*[0-9]))).*$", "g");

    // Must be at least 6 characters long
    var okRegex = new RegExp("(?=.{6,}).*", "g");

    if (okRegex.test($(this).val()) === false) 
    {
        // If ok regex doesn't match the password
        $('#passwordStrength').removeClass().addClass('alert alert-error').html('Le mot de passe doit contenir au moin 6 caractére !');

    } 
    else if (strongRegex.test($(this).val())) 
    {
        // If reg ex matches strong password
        $('#passwordStrength').removeClass().addClass('alert alert-success').html('Excellent mot de passes !');
        $('#barre').width(185);
        $('#barre').css('background-color','green');

    } 
    else if (mediumRegex.test($(this).val())) 
    {
        // If medium password matches the reg ex
        $('#passwordStrength').removeClass().addClass('alert alert-info').html('Ajouter des Majuscules, des Chifre mais ausssi des caractère speciaux !');
        $('#barre').width(140);
        $('#barre').css("background-color","yellow");

    } 
    else 
    {
        // If password is ok
        $('#passwordStrength').removeClass().addClass('alert alert-error').html('Mot de passe faible, Ajouter des Majuscules.');
        $("#barre").width(90);
        $("#barre").css("background-color","red");
    }
    if($('#password').val() == '')
    {
        console.log('toto');
        $("#barre").width(0);
        $("##passwordStrength").removeClass().html("");
    }

    return true;
});
})

</script>
    
@endsection



