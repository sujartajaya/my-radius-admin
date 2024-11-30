<?php
   $mac=$_REQUEST['mac'];
   $ip=$_REQUEST['ip'];
   $username=$_REQUEST['username'];
   $linklogin=$_REQUEST['link-login'];
   $linkorig=$_REQUEST['link-orig'];
   $error=$_REQUEST['error'];
   $chapid=$_REQUEST['chap-id'];
   $chapchallenge=$_REQUEST['chap-challenge'];
   $linkloginonly=$_REQUEST['link-login-only'];
   $linkorigesc=$_REQUEST['link-orig-esc'];
   $macesc=$_REQUEST['mac-esc'];
 ?>

<!doctype html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://cdn.tailwindcss.com"></script>
  <script>
    tailwind.config = {
      theme: {
        extend: {
          colors: {
            clifford: '#da373d',
          }
        }
      }
    }
  </script>
</head>
<body>
        <form name="sendin" action="<?php echo $linklogin; ?>" method="post">
          <input type="hidden" name="username" />
          <input type="hidden" name="password" />
          <input type="hidden" name="dst" value="<?php echo $linkorig; ?>" />
          <input type="hidden" name="popup" value="true" />
        </form>
        
        <script type="text/javascript" src="./md5.js"></script>
        <script type="text/javascript">
            function doLogin() {
                  <?php if(strlen($chapid) < 1) echo "return true;\n"; ?>
                  document.sendin.username.value = document.login.username.value;
                  document.sendin.password.value = hexMD5('<?php echo $chapid; ?>' + document.login.password.value + '<?php echo $chapchallenge; ?>');
                  document.sendin.submit();
                  return false;
            }
        </script>

        <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto lg:py-0 mt-10">
            <div class="w-full bg-white rounded-lg shadow dark:border md:mt-0 sm:max-w-md xl:p-0">
                <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                    <img src="/logo_tsi.png" alt="Logo tsi"/>
                    <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl items-center">
                        Welcome to Bali Marine Park
                    </h1>
                    <form class="space-y-4 md:space-y-6" action="/tsi/process.php" method="post">
                        <div>
                            <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your email</label>
                            <input type="email" name="email" id="email" class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5" placeholder="name@company.com" required="" autofocus >
                        </div>
                        <button type="submit" class="w-full text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Sign in</button>
                    </form>
                </div>
            </div>
        </div>
</body>
</html>