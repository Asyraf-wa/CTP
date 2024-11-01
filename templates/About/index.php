<link rel="stylesheet" type='text/css' href="https://cdn.jsdelivr.net/gh/devicons/devicon@latest/devicon.min.css" />
<link href="https://fonts.googleapis.com/css?family=Roboto+Mono&display=swap" rel="stylesheet">
<?php echo $this->Html->css('terminal.css'); ?>

<div class="container-fluid bg_me">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="about_all">
                    <div class="div">
                        <h5>Hello there👋, I’m</h5>
                    </div>
                    <div class="div">
                        <h1 class="fw-bold">Asyraf Wahi Anuar</h1>
                    </div>
                    <div class="mt-2">Informatic Lecturer | Full-Stack Developer</div>
                    <div class="mt-2">PHP • CakePHP • CodeIgniter • Laravel • SQL • MongoDB • JS • Android • Tailwind • Linux • Joomla!</div>
                    <div class="mt-2">Working remotely from Malaysia 🌍🍝</div>
                    <div class="div">Check out my CV!</div>
                    <div class="div"></div>
                </div>
            </div>
            <div class="col-md-6 ctp_logo d-none d-sm-block">
                <h1 class="gradient-animate"><b class="logo_big">&lt;/&gt;</b></h1>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid pt-5" style="background: linear-gradient(to left, rgba(173, 83, 137, 0.5), rgba(60, 16, 83, 0.5));
">
    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-8">
            <div id="root"></div>
        </div>
        <div class="col-md-2"></div>
    </div>

</div>

<div class="container">



    <div class="row mt-5">
        <div class="col-md-4 d-flex align-items-stretch">
            <div class="card bg-body-tertiary border-0 shadow mb-4">
                <div class="card-body mx-3 my-3">
                    <h4 class="fw-bold">Skills</h4>
                    <div class="justify">Below are the icons representing my diverse abilities in programming. Each icon highlights a specific skill that I have mastered, from front-end development to back-end programming, and everything in between. Let’s dive into the world of code and innovation together! 🚀</div>
                    <div class="dev_icon my-4">
                        <i class="devicon-cakephp-plain mx-1 my-1"></i>
                        <i class="devicon-php-plain mx-1 my-1"></i>
                        <i class="devicon-mysql-original mx-1 my-1"></i>
                        <i class="devicon-apache-plain mx-1 my-1"></i>
                        <i class="devicon-bootstrap-plain mx-1 my-1"></i>
                        <i class="devicon-javascript-plain mx-1 my-1"></i>
                        <i class="devicon-html5-plain mx-1 my-1"></i>
                        <i class="devicon-css3-plain mx-1 my-1"></i>
                        <i class="devicon-github-original mx-1 my-1"></i>
                        <i class="devicon-composer-line mx-1 my-1"></i>
                        <i class="devicon-androidstudio-plain mx-1 my-1"></i>
                        <i class="devicon-powershell-plain mx-1 my-1"></i>
                        <i class="devicon-cplusplus-plain mx-1 my-1"></i>
                        <i class="devicon-mongodb-plain mx-1 my-1"></i>
                        <i class="devicon-github-original mx-1 my-1"></i>
                        <i class="devicon-powershell-plain mx-1 my-1"></i>
                        <i class="devicon-vscode-plain mx-1 my-1"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4 d-flex align-items-stretch">
            <div class="card bg-body-tertiary border-0 shadow mb-4">
                <div class="card-body mx-3 my-3">
                    <h4 class="fw-bold">Fullstack Certification Journey</h4>
                    <div class="justify">My journey of finishing online coursework for my Full-Stack Certification.</div>
                    <div class="my-4">
                        ✅ Responsive Web Design Certification<br />
                        ➖ JavaScript Algorithms and Data Structures Certification<br />
                        ➖ Front End Libraries Certification<br />
                        ➖ Data Visualization Certification<br />
                        ➖ APIs and Microservices Certification<br />
                        ➖ Quality Assurance Certification
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4 d-flex align-items-stretch">
            <div class="card bg-body-tertiary border-0 shadow mb-4">
                <div class="card-body mx-3 my-3">
                    <h4 class="fw-bold">Teaching Subject</h4>
                    <div class="justify">Dive into the World of Informatics with My Teaching Subjects:</div>
                    <div class="my-4">
                        ✅ Advance Web Design Development and Content Management<br />
                        ✅ Problem Solving And Program Design 2<br />
                        ✅ Algorithm and Data Structure<br />
                        ✅ Basic web Design and Content Management<br />
                        ✅ Development of Electronic Records System<br />
                        ✅ Introduction To Web Content Management and Design<br />
                        ✅ Information and Communication Technology Application<br />
                        ✅ Database for Information Professional
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<div class="container-fluid px-0 pt-5" style="margin-bottom: 150px;">
    <div class="map">
        <div class="container contact shadow p-4">
            <h4 class="fw-bold">Contact </h4>

            <?php
            $length =   7;
            $chrDb  =   array('A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'J', 'K', 'M', 'N', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z', '2', '3', '4', '5', '6', '7', '8', '9');

            $str = '';
            for ($count = 0; $count < $length; $count++) {

                $chr = $chrDb[rand(0, count($chrDb) - 1)];

                if (rand(0, 1) == 0) {
                    $chr = strtolower($chr);
                }
                if (3 == $count) {
                    $str .= '-';
                }
                $str .= $chr;
            }
            ?>

            <?= $this->Form->create(null, ['url' => ['controller' => 'Contacts', 'action' => 'add']]) ?>

            <div class="row">
                <div class="col-2">
                    <div class="badge bg-primary text-wrap">
                        Ticket ID:
                    </div>
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="" aria-label="Copy" aria-describedby="button-addon2" value="<?= $str; ?>" id="ticketid" size="100%" disabled>
                        <button class="btn btn-outline-secondary" onclick="myFunction()"><i class="far fa-clipboard"></i></button>
                    </div>
                </div>
                <div class="col-10">
                    <fieldset>
                        <?php echo $this->Form->hidden('ticket', ['class' => 'form-control', 'required' => false, 'value' => $str, 'label' => 'Ticket ID']); ?>
                        <?php echo $this->Form->control('subject', ['class' => 'form-control', 'required' => false]); ?>
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <?php echo $this->Form->control('name', ['class' => 'form-control', 'required' => false]); ?>
                </div>
                <div class="col">
                    <?php echo $this->Form->control('email', ['class' => 'form-control', 'required' => false]); ?>
                </div>
            </div>

            <?php echo $this->Form->textarea('notes', ['class' => 'form-control', 'required' => false]); ?>
            <?php
            /* if ($this->Identity->isLoggedIn()) {
    echo '';
}else
	echo $this->Captcha->render(['placeholder' => __('Please solve the riddle')]); */
            ?>
            <?php //echo $this->Captcha->render(['placeholder' => __('Please solve the riddle')]); 
            ?>
            <div class="h-captcha" data-sitekey="<?php echo $hcaptcha_sitekey; ?>"></div>
            </fieldset>
            <div class="text-end mt-2">
                <?= $this->Form->button('Reset', ['type' => 'reset', 'class' => 'btn btn-primary btn-flat btn-sm']) ?>
                <?= $this->Form->button(__('Submit'), ['type' => 'submit', 'class' => 'btn btn-primary btn-flat btn-sm']) ?>
                <?= $this->Form->end() ?>
            </div>
        </div>


        <script>
            function myFunction() {
                /* Get the text field */
                var copyText = document.getElementById("ticketid");

                /* Select the text field */
                copyText.select();
                copyText.setSelectionRange(0, 99999); /* For mobile devices */

                /* Copy the text inside the text field */
                navigator.clipboard.writeText(copyText.value);

                /* Alert the copied text */
                alert("Reference copied: " + copyText.value);
            }
        </script>


    </div>
</div>
</div>





<script src='https://cdnjs.cloudflare.com/ajax/libs/react/16.12.0/umd/react.production.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/react-dom/16.11.0/umd/react-dom.production.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/mathjs/6.6.0/math.min.js'></script>
<script src='https://cdn.jsdelivr.net/npm/react-simple-keyboard@2.1.113/build/index.min.js'></script>
<?php echo $this->Html->script('terminal.js'); ?>