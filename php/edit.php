<html>
    <head>
        <!-- Page Info -->
        <meta charset="utf-8">
        <title>NYUMeet</title>
        <meta name="description" content="Meet other NYU students!">
        <meta name="author" content="NYUMeet team">

        <!-- Mobile Compatibility -->
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">   

        <!-- CSS -->
        <link rel="stylesheet" href="../css/main.css">
        <link rel="stylesheet" href="../css/form.css">

        <!-- Favicon and Site Title -->
        <title>NYUMeet</title>
    </head>

    <header>
        <div>
            <div class="titleBar">
                <div class="leftTitleBar">
                </div>
                <div class="middleTitleBar">
                    <a href="../index.php"><h3 class="titleBrand">NYUMeet</h3></a>
                </div>
                <div class="rightTitleBar">
                    <h4 class="menuItem activeMenuItem">Sign Out</h4>
                </div>
            </div>
        </div>
    </header>

    <body>
        <div class="formSection">
            <h4 class="text">What is your school at NYU?</h4>
            <select name="q1" id="q1">
                <option disabled selected value/>
                <option value="CAS">CAS</option>
                <option value="Gallatin">Gallatin</option>
                <option value="LS">Liberal Studies</option>
                <option value="Nursing">Nursing</option>
                <option value="PS">Professional Studies</option>
                <option value="Silver">Silver</option>
                <option value="Steinhardt">Steinhardt</option>
                <option value="Stern">Stern</option>
                <option value="Tandon">Tandon</option>
                <option value="Tisch">Tisch</option>
              </select>
    
            <h4 class="text">Are you an introvert or extrovert</h4>
            <select name="q2" id="q2">
                <option disabled selected value/>
                <option value="1">Introvert</option>
                <option value="2">Ambivert</option>
                <option value="3">Extrovert</option>
            </select>
    
            <h4 class="text">Are you more emotional or logical?</h4>
            <select name="q3" id="q3">
                <option disabled selected value/>
                <option value="1">Emotional</option>
                <option value="2">In-between</option>
                <option value="3">Logical</option>
            </select>
    
            <h4 class="text">Which activity do you prefer?</h4>
            <select name="q4" id="q4">
                <option disabled selected value/>
                <option value="1">Partying</option>
                <option value="2">Museum</option>
                <option value="3">Reading</option>
                <option value="4">TV</option>
                <option value="5">Hanging out with friends</option>
                <option value="6">Exploring the city</option>
            </select>
    
            <h4 class="text">Which topic do you like to talk about?</h4>
            <select name="q5" id="q5">
                <option disabled selected value/>
                <option value="1">Politics/News</option>
                <option value="2">School</option>
                <option value="3">Daily Life</option>
                <option value="4">Science and tech</option>
                <option value="5">Art</option>
                <option value="6">History</option>
                <option value="7">TV/Movies</option>
                <option value="8">Hobbies</option>
                <option value="9">Games</option>
                <option value="10">Business</option>
            </select>
    
            <h4 class="text">How organized are you?</h4>
            <select name="q5" id="q5">
                <option disabled selected value/>
                <option value="1">Not organized</option>
                <option value="2">Somewhat organized</option>
                <option value="3">Organized</option>
            </select>
    
            <h4 class="text">How punctual are you?</h4>
            <select name="q5" id="q5">
                <option disabled selected value/>
                <option value="1">Not very punctual</option>
                <option value="2">Somewhat punctual</option>
                <option value="3">Very punctual</option>
            </select>
    
            <h4 class="text">What personality best describes you?</h4>
            <select name="q5" id="q5">
                <option disabled selected value/>
                <option value="1">Friendly</option>
                <option value="2">Spontaneous</option>
                <option value="4">Confident</option>
                <option value="5">Trusting</option>
                <option value="6">Imaginative</option>
                <option value="7">Optimistic</option>
                <option value="8">Helpful</option>
                <option value="9">Curious</option>
                <option value="10">Straightforward</option>
            </select>
    
            <h4 class="text">Give a quick bio about yourself</h4>
            <textarea maxlength=512 cols=100 rows=8 id="bio" name="bio" placeholder="Tell others about yourself! Some things to talk about are your interests, what you want in a friendship, your favorite tv show, or your favorite activity!"></textarea>

            <h4 class="text">Snapchat Username</h4>
            <input type="text" placeholder="Enter Snapchat Username" name="snap" required>

            <h4 class="text">Zoom Username</h4>
            <input type="text" placeholder="Enter Zoom Username" name="zoom" required>

            <h4 class="text">Instagram Username</h4>
            <input type="text" placeholder="Enter Instagram Username" name="instagram" required>

            <button class="buttonSubmit">Submit</button>
        </div>
    </body>
</html>