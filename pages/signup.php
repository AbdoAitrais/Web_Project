<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://fonts.googleapis.com/css?family=Nunito' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    
    <link rel="stylesheet" href="signup.css">
    <title>Signup</title>
</head>
<body>
    <div id="page" class="site">
        <div class="container">
            <div class="form-box">
                <div class="progress">
                    <div class="logo"><a href=""><span>FST</span>AGE</a></div>
                    <ul class="progress-steps">
                        <li class="step active">
                            <span>1</span>
                            <p>Personal<br></p>
                        </li>
                        <li class="step">
                            <span>2</span>
                            <p>Contact<br></p>
                        </li>
                        <li class="step">
                            <span>3</span>
                            <p>Studies<br></p>
                        </li>
                        <li class="step">
                            <span>4</span>
                            <p>Security<br></p>
                        </li>
                    </ul>
                </div>
                <form action="back_end/Signup_Etu.php" method="post" enctype="multipart/form-data" id="form">
                    <div class="form-one form-step active">
                        <div class="bg-svg"></div>
                        <h2>Personal Information</h2>
                        <p>Enter your personal information correctly</p>
                        <div class="containerim">
                            
                            <div class="avatar-upload">
                                <div class="avatar-edit">
                                    <input type='file' name="imageUpload" id="imageUpload" accept=".png, .jpg, .jpeg" />
                                    <label for="imageUpload"></label>
                                </div>
                                <div class="avatar-preview">
                                    <div id="imagePreview" style="background-image: url('icons/avatar.png');">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div>
                            <label for="prenom_etu">First Name</label>
                            <input class="step1_input" type="text" name="prenom_etu" id="prenom_etu" placeholder="e.g. John" required>
                        </div>
                        <div>
                            <label for="nom_etu">Last Name</label>
                            <input class="step1_input" type="text"  name="nom_etu" id="nom_etu" placeholder="e.g. Paul" required>
                        </div>
                        <div class="birth">
                            <label for="id">Date of Birth</label>
                            <div class="grouping">
                                <input class="step1_input" type="text" pattern="[0-9]*" name="day" value="" min="0" max="31" placeholder="DD" required>
                                <input class="step1_input" type="text" pattern="[0-9]*" name="month" value="" min="0" max="12" placeholder="MM" required>
                                <input class="step1_input" type="text" pattern="[0-9]*" name="year" value="" min="0" placeholder="MM" required>
                            </div>
                        </div>
                        <div>
                            <label for="cin">CIN</label>
                            <input class="step1_input" type="text"  name="cin" id="cin" placeholder="" required>
                        </div>
                        <div>
                            <label for="">CV</label>
                            <button type = "button" class = "btn-warnin">
                                <i class = "fa fa-upload"></i> Upload File
                                <input type="file"  name="cvUpload">
                              </button>
                        </div>
                    </div>
                    
                    <div class="form-two form-step">
                        <div class="bg-svg"></div>
                        <h2>Contact</h2>
                        <div>
                            <label for="number">Phone</label>
                            <input class="step2_input" type="text" name="number" id="number" placeholder="+212xxxxxxxxx"required>
                        </div>
                        <div>
                            <label for="adress">Adress</label>
                            <input class="step2_input" type="text" name="adress" id="adress" placeholder="Street Adress" required>
                        </div>
                        <div>
                            <label for="city">City</label>
                            <input class="step2_input" type="text" name="city" id="city" placeholder="City" required>
                        </div>
                       
                        
                       
                    </div>
                    <div class="form-three form-step">
                        <div class="bg-svg"></div>
                        <h2>Studies</h2>
                        <div>
                            <label for="cne">CNE</label>
                            <input class="step3_input" type="text" name="cne"  id="cne" placeholder="" required>
                        </div>
                        <div style="display: inline-block !important; ">
                            <label for="type">Type</label>
                            <select class="step3_input" name="type" id="type_filiere" required>
                                <option value="">Please select</option>
                                <option value="1" selected>Cycle</option>
                                <option value="2">Master</option>
                                <option value="0">Liscence</option>
                            </select>
                            <label for="filière" style="margin-left: 25px;">Filière</label>
                            <select name="filière" id="filiere_Cycle" required>
                                <option value="">Select Cycle</option>
                                <option value="1">GET</option>
                                <option value="2">GE</option>
                                <option value="3">GMI</option>
                                <option value="4">GPE</option>
                                <option value="5">ILISI</option>
                            </select>
                            <select name="filière" id="filiere_LST" style="display:none;" required>
                                <option value="">Select LST</option>
                                <option value="1">GT</option>
                                <option value="2">GE2I</option>
                                <option value="3">IRM</option>
                                <option value="4">MA</option>
                                <option value="5">PA</option>
                                <option value="6">GM</option>
                                <option value="7">ABCQ</option>
                                <option value="8">TB</option>
                                <option value="9">TACQ</option>
                                <option value="10">CA</option>
                                <option value="11">GEE</option>
                            </select>
                            <select name="filière" id="filiere_Master" style="display:none;" required >
                                <option value="">Select Master</option>
                                <option value="1">MQSA</option>
                                <option value="2">MAGBio</option>
                                <option value="3">ISERT</option>
                                <option value="4">PCAM</option>
                                <option value="5">SGE</option>
                                <option value="6">IPMA</option>
                                <option value="7">MQSE</option>
                            </select>
                        </div>
                        <div id="niv_cycle">
                            <label for="niveau">Niveau</label>
                            <select name="niveau" id="niveau_cycle" required>
                                <option value="">Please select</option>
                                <option value="1">1er anneé</option>
                                <option value="2">2ème anneé</option>
                                <option value="3">3ème anneé</option>
                            </select>
                        </div>  
                        <div style="display:none;" id="niv_master">
                            <label for="niveau">Niveau</label>
                            <select name="niveau" id="niveau_master" required>
                                <option value="">Please select</option>
                                <option value="1">1er anneé</option>
                                <option value="2">2ème anneé</option>
                            </select>
                        </div>     
                        <div>
                            <label for="promo">Promotion</label>
                            <select name="promo" id="promo" required>
                                <option value="">Please select</option>
                                <option value="2022">2022</option>
                                <option value="2023">2023</option>
                                <option value="2024">2024</option>
                            </select>
                        </div>       
                    </div>
                    <div class="form-four form-step">
                        <div class="bg-svg"></div>
                        <h2>Security</h2>
                        <div>
                            <label for="email">Email</label>
                            <input type="email" name="user_mail" id="email" placeholder="Your email address" required>
                        </div>
                        <div>
                            <label for="pass">Password</label>
                            <input type="password" name="pass" id="pass" placeholder="Password" required>
                        </div>
                        <div>
                            <input type="password" id="confirm_pass" placeholder="Confirm Password" required>
                        </div>
                        <div class="checkbox">
                            <input type="checkbox">
                            <label for="">Please Confirm You Are Not a Robot</label>
                        </div>
                    </div>
                    <div class="btn-group">
                        <button type="button" class="btn-prev" disabled>Back</button>
                        <button type="button" class="btn-next" id="button_next" disabled>Next Step</button>
                        <button type="submit" class="btn-submit">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- <script src="signup.js"></script> -->
    <script>


        var type_filiere = $('#type_filiere');
        var cycle = $('#filiere_Cycle');
        var lst = $('#filiere_LST');
        var master = $('#filiere_Master');
        var niv_cycle = $('#niv_cycle');
        var niv_master = $('#niv_master');
        var button_next = $('.btn-next');
        var number = 0;
        var page = 1;
        var inputs = $('form#form :input');
        var input_name = $('#prenom_etu');

        const nextButton = document.querySelector('.btn-next');
const prevButton = document.querySelector('.btn-prev');
const steps = document.querySelectorAll('.step');
const form_steps = document.querySelectorAll('.form-step');
let active = 1;

nextButton.addEventListener('click', () => {
    active++;
    if(active > steps.length) {
        active = steps.length;
    }
    updateProgress();
})

prevButton.addEventListener('click', () => {
    active--;
    if(active < 1) {
        active = 1;
    }
    updateProgress();
})

const updateProgress = () => {
    steps.forEach((step, i) => {
        if(i == (active-1)) {
            step.classList.add('active');
            form_steps[i].classList.add('active');
            console.log('i =>' +i);
            number = i;
        } else {
            step.classList.remove('active');
            form_steps[i].classList.remove('active');
        }
    });

    //enable or disable prev and next buttons
    if(active === 1) {
        prevButton.disabled = true;
    } else if(active === steps.length) {
        nextButton.disabled = true;
    } else {
        prevButton.disabled = false;
        nextButton.disabled = false;
    }
}

function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
            $('#imagePreview').css('background-image', 'url('+e.target.result +')');
            $('#imagePreview').hide();
            $('#imagePreview').fadeIn(650);
        }
        reader.readAsDataURL(input.files[0]);
    }
}
$("#imageUpload").change(function() {
    readURL(this);
});


        type_filiere.on('load change', function () {
            if( this.value == '1' )
            {
                cycle.show();
                lst.hide();
                master.hide();
                niv_cycle.show();
                niv_master.hide();
            }
            else if( this.value == '2' )
            {
                cycle.hide();
                lst.hide();
                master.show();
                niv_cycle.hide();
                niv_master.show();
            }
            else if( this.value == '0' )
            {
                cycle.hide();
                lst.show();
                master.hide();
                niv_cycle.hide();
                niv_master.hide();
            }

        })

        
            
            // var init = 0;
            // var fin = 0;
            // var is_empty = false;

            // console.log(number);

            
            // function num_update(){
                
            //     switch(number) {
            //     case 0:
            //         init = 1;
            //         fin = 7;
            //         break;
            //     case 1:
            //         init = 8;
            //         fin = 11;
            //         break;
            //     case 2:
            //         init = 11;
            //         fin = 12;
            //         break;
            //     default:
                    
            // }
            // }


            
            

            $(".step1_input").on('focus keyup', function disable_next() {
                            
                console.log(this.value);

                is_empty = false;

                $(".step1_input").each(function () {
                    if ( this.value == '' )
                        is_empty = true;
                })
                
                if(is_empty == false)
                    button_next.prop("disabled",false);
                else
                    button_next.prop("disabled",true);



            });

            button_next.on('click', function(){
                button_next.prop("disabled",true);
            })


            $(".step2_input").on('focus keyup', function disable_next() {
                            
                console.log(this);
            
                is_empty = false;
            
                $(".step2_input").each(function () {
                    if ( this.value == '' )
                        is_empty = true;
                    })
                            
                    if(is_empty == false)
                        button_next.prop("disabled",false);
                    else
                        button_next.prop("disabled",true);

            });
            
            $(".step3_input").on('focus keyup change', function disable_next() {
                            
                            console.log(this);
                        
                            is_empty = false;
                        
                            $(".step3_input").each(function () {
                                if ( this.value == '' )
                                    is_empty = true;
                                })
                                        
                                if(is_empty == false)
                                    button_next.prop("disabled",false);
                                else
                                    button_next.prop("disabled",true);
            
                        });

    </script>
</body>
</html>