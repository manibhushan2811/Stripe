<?php 
   session_start();
//    require('config.php');
   include("config.php");
   if(!isset($_SESSION['valid'])){
    header("Location: index.php");
   }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Home</title>
    <style>
  body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    background: #0000;
  }
  .toggle-buttons {
    text-align: center;
    margin: 20px;
  }
  .toggle-button {
    padding: 10px 20px;
    font-size: 16px;
    cursor: pointer;
    border: none;
    background-color: #f2f2f2;
    transition: background-color 0.3s ease;
  }
  .toggle-button.selected {
    background-color: #ccc;
  }
  .container {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 20px;
    padding: 20px;
  }
  .plan {
    border: 1px solid #ddd;
    border-radius: 10px;
    padding: 20px;
    text-align: center;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
  }
  .plan:hover {
    transform: translateY(-10px);
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
  }
  .plan h3 {
    margin-top: 0;
  }
  .price {
    font-size: 24px;
    margin: 10px 0;
  }
  .buy-button {
    background-color: #007bff;
    color: #fff;
    border: none;
    padding: 8px 16px;
    cursor: pointer;
    font-size: 14px;
    transition: background-color 0.3s ease;
  }
  .buy-button:hover {
    background-color: #0056b3;
  }

    </style>
</head>
<body>
    <div class="nav">
        <div class="logo">
            <p><a href="home.php">Logo</a> </p>
        </div>

        <div class="right-links">
        <?php 
            
            $id = $_SESSION['id'];
            $query = mysqli_query($con,"SELECT*FROM users WHERE Id=$id");

            while($result = mysqli_fetch_assoc($query)){
                $res_Uname = $result['Username'];
                $res_Email = $result['Email'];
                $res_id = $result['Id'];
            }
            
            // echo "<a href='edit.php?Id=$res_id'>Change Profile</a>";
             ?>
             <a href="logout.php"> <button class="btn">Log Out</button> </a>

        </div>
    </div>
    <main>

       <div class="main-box top">
          <div class="top">
            <div class="box">
                <p>Hello <b><?php echo $res_Uname ?></b>, Welcome</p>
                <p>Subscribe now and start <br> streaming</p>
            </div>
            
          </div>
          
       </div>

    </main>
    
  <h2 style="text-align: center;">Select a Subscription Plan</h2>
  <div class="toggle-buttons">
    <button class="toggle-button selected" id="monthly-btn">Monthly</button>
    <button class="toggle-button" id="yearly-btn">Yearly</button>
  </div>
  <div class="container">
    <div class="plan">
      <h3>Basic</h3>
      <div class="price" data-monthly="100" data-yearly="1000">100 INR</div>
      <p>Good Video Quality</p>
      <p>Resolution: 480p</p>
      <p>Devices: Phone</p>
      <p>Active Screens: 1</p>
      <button class="buy-button">Buy Now</button>
    </div>
    <div class="plan">
      <h3>Standard</h3>
      <div class="price" data-monthly="200" data-yearly="2000">200 INR</div>
      <p>Good Video Quality</p>
      <p>Resolution: 720p</p>
      <p>Devices: Phone+Tablet</p>
      <p>Active Screens: 3</p>
      <button class="buy-button">Buy Now</button>
    </div>
    <div class="plan">
      <h3>Premium</h3>
      <div class="price" data-monthly="500" data-yearly="5000">500 INR</div>
      <p>Better Video Quality</p>
      <p>Resolution: 1080p</p>
      <p>Devices: Phone+Tablet+Computer</p>
      <p>Active Screens: 5</p>
      <button class="buy-button">Buy Now</button>
    </div>
    <div class="plan">
      <h3>Regular</h3>
      <div class="price" data-monthly="700" data-yearly="7000">700 INR</div>
      <p>Best Video Quality</p>
      <p>Resolution: 4K+HDR</p>
      <p>Devices: Phone+Tablet+TV</p>
      <p>Active Screens: 10</p>
      <button class="buy-button">Buy Now</button>
    </div>
  </div>
  

  
  <script>
    const monthlyBtn = document.getElementById('monthly-btn');
    const yearlyBtn = document.getElementById('yearly-btn');
    const cells = document.querySelectorAll('.price');

    cells.forEach(cell => {
      const buyButton = cell.parentElement.querySelector('.buy-button');

      buyButton.addEventListener('click', function() {
        const selectedPlan = cell.parentElement.querySelector('h3').textContent;
        const selectedPrice = cell.getAttribute(cell.parentElement.children[1].classList.contains('selected') ? 'data-monthly' : 'data-yearly');
        const selectedVideoQuality = cell.parentElement.querySelectorAll('p')[0].textContent;
        const selectedResolution = cell.parentElement.querySelectorAll('p')[1].textContent;
        const selectedDevices = cell.parentElement.querySelectorAll('p')[2].textContent;
        const selectedActiveScreens = cell.parentElement.querySelectorAll('p')[3].textContent;

        // You can now pass this data to your payment page and handle the payment process there.
        console.log('Selected Plan:', selectedPlan);
        console.log('Billing Interval:', cell.parentElement.children[1].classList.contains('selected') ? 'Monthly' : 'Yearly');
        console.log('Price:', selectedPrice, 'INR');
        console.log('Video Quality:', selectedVideoQuality);
        console.log('Resolution:', selectedResolution);
        console.log('Devices:', selectedDevices);
        console.log('Active Screens:', selectedActiveScreens);
      });
    });

    monthlyBtn.addEventListener('click', function() {
      monthlyBtn.classList.add('selected');
      yearlyBtn.classList.remove('selected');
      cells.forEach(cell => {
        const monthlyPrice = cell.getAttribute('data-monthly');
        cell.textContent = `${monthlyPrice} INR`;
      });
    });

    yearlyBtn.addEventListener('click', function() {
      yearlyBtn.classList.add('selected');
      monthlyBtn.classList.remove('selected');
      cells.forEach(cell => {
        const yearlyPrice = cell.getAttribute('data-yearly');
        cell.textContent = `${yearlyPrice} INR`;
      });
    });
  </script>

</body>
</html>