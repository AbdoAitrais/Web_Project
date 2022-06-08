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
                <form action="back_end/Signup_Etu.php" method="post">
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
                                    <div id="imagePreview" style="background-image: url('../icons/avatar.png');">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div>
                            <label for="prenom_etu">First Name</label>
                            <input type="text" name="prenom_etu" id="prenom_etu" placeholder="e.g. John">
                        </div>
                        <div>
                            <label for="nom_etu">Last Name</label>
                            <input type="text"  name="nom_etu" id="nom_etu" placeholder="e.g. Paul">
                        </div>
                        <div class="birth">
                            <label for="id">Date of Birth</label>
                            <div class="grouping">
                                <input type="text" pattern="[0-9]*" name="day" value="" min="0" max="31" placeholder="DD">
                                <input type="text" pattern="[0-9]*" name="month" value="" min="0" max="12" placeholder="MM">
                                <input type="text" pattern="[0-9]*" name="year" value="" min="0" placeholder="MM">
                            </div>
                        </div>
                        <div>
                            <label for="">CIN</label>
                            <input type="text"  name="CIN" placeholder="">
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
                            <label for="">Phone</label>
                            <input type="text" name="number" placeholder="+212xxxxxxxxx">
                        </div>
                        <div>
                            <label for="">Adress</label>
                            <input type="text" name="adress" placeholder="Street Adress">
                        </div>
                        <div>
                            <label for="">City</label>
                            <input type="text" name="city" placeholder="City">
                        </div>
                       
                        
                       
                    </div>
                    <div class="form-three form-step">
                        <div class="bg-svg"></div>
                        <h2>Studies</h2>
                        <div>
                            <label for="">CNE</label>
                            <input type="text" name="CNE" placeholder="">
                        </div>
                        <div style="display: inline-block !important; ">
                            <label for="">Type</label>
                            <select name="Filière" id="Filière">
                                <option value="">Please select</option>
                                <option value="1">Cycle</option>
                                <option value="2">Master</option>
                                <option value="3">Liscence</option>
                            </select>
                            <label for="" style="margin-left: 25px;">Filière</label>
                            <select name="Filière" id="Filière">
                                <option value="">Please select</option>
                                <option value="1">ILISI</option>
                                <option value="2">GET</option>
                                <option value="3">GMI</option>
                            </select>
                        </div>
                        <div>
                            <label for="">Niveau</label>
                            <select name="Filière" id="Filière">
                                <option value="">Please select</option>
                                <option value="1">1er anneé</option>
                                <option value="2">2ème anneé</option>
                                <option value="3">3ème anneé</option>
                            </select>
                        </div>    
                        <div>
                            <label for="">Promotion</label>
                            <select name="Filière" id="Filière">
                                <option value="">Please select</option>
                                <option value="Afghanistan">2022</option>
                                <option value="Afghanistan">2023</option>
                                <option value="Afghanistan">2024</option>
                            </select>
                        </div>       
                    </div>
                    <div class="form-four form-step">
                        <div class="bg-svg"></div>
                        <h2>Security</h2>
                        <div>
                            <label for="">Email</label>
                            <input type="email" placeholder="Your email address">
                        </div>
                        <div>
                            <label for="">Password</label>
                            <input type="text" placeholder="Password">
                        </div>
                        <div>
                            <input type="text" placeholder="Confirm Password">
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