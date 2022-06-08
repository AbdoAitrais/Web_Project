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
                            <p>Contact<br></p>
                        </li>
                        <li class="step">
                            <span>4</span>
                            <p>Security<br></p>
                        </li>
                    </ul>
                </div>
                <form action="back_end/Signup_Etu.php" method="post" enctype="multipart/form-data">
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
                            <input type="text" name="prenom_etu" id="prenom_etu" placeholder="e.g. John" required>
                        </div>
                        <div>
                            <label for="nom_etu">Last Name</label>
                            <input type="text"  name="nom_etu" id="nom_etu" placeholder="e.g. Paul" required>
                        </div>
                        <div class="birth">
                            <label for="id">Date of Birth</label>
                            <div class="grouping">
                                <input type="text" pattern="[0-9]*" name="day" value="" min="0" max="31" placeholder="DD" required>
                                <input type="text" pattern="[0-9]*" name="month" value="" min="0" max="12" placeholder="MM" required>
                                <input type="text" pattern="[0-9]*" name="year" value="" min="0" placeholder="MM" required>
                            </div>
                        </div>
                        <div>
                            <label for="cin">CIN</label>
                            <input type="text"  name="cin" id="cin" placeholder="" required>
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
                            <input type="text" name="number" id="number" placeholder="+212xxxxxxxxx"required>
                        </div>
                        <div>
                            <label for="adress">Adress</label>
                            <input type="text" name="adress" id="adress" placeholder="Street Adress" required>
                        </div>
                        <div>
                            <label for="city">City</label>
                            <input type="text" name="city" id="city" placeholder="City" required>
                        </div>
                       
                        
                       
                    </div>
                    <div class="form-three form-step">
                        <div class="bg-svg"></div>
                        <h2>Studies</h2>
                        <div>
                            <label for="cne">CNE</label>
                            <input type="text" name="cne"  id="cne" placeholder="" required>
                        </div>
                        <div style="display: inline-block !important; ">
                            <label for="type">Type</label>
                            <select name="type" id="type" required>
                                <option value="">Please select</option>
                                <option value="1">Cycle</option>
                                <option value="2">Master</option>
                                <option value="0">Liscence</option>
                            </select>
                            <label for="filière" style="margin-left: 25px;">Filière</label>
                            <select name="filière" id="filière" required>
                                <option value="">Please select</option>
                                <option value="1">ILISI</option>
                                <option value="2">GET</option>
                                <option value="3">GMI</option>
                            </select>
                        </div>
                        <div>
                            <label for="niveau">Niveau</label>
                            <select name="niveau" id="niveau" required>
                                <option value="">Please select</option>
                                <option value="1">1er anneé</option>
                                <option value="2">2ème anneé</option>
                                <option value="3">3ème anneé</option>
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
                        <button type="button" class="btn-next">Next Step</button>
                        <button type="submit" class="btn-submit">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="signup.js"></script>
</body>
</html>