
<?php
    //  print_r($data['data']['result']);exit;
    //  echo $data['data']['result']->nama_member ? $data['data']['result']->nama_member : ''
?>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
	<head>
		<title>card</title>
<style>
  body{
		  	background:#008080;
		  }
#bg {
  width: 1000px;
  height: 450px;
 
  margin:60px;
 	float: left; 
 		
}

#id {
  width:250px;
  height:450px;
  position:absolute;
  opacity: 0.88;
font-family: sans-serif;

		  	transition: 0.4s;
		  	/* background-color: #FFFFFF; */
		  	border-radius: 2%;
		}

#id::before {
  content: "";
  position: absolute;
  width: 100%;
  height: 100%;
  background: url('<?php echo base_url()."assets/dist/assets/images/bkg-4.jpg" ?>');   /*if you want to change the background image replace logo.png*/
  background-repeat:repeat-x;
  background-size: 250px 450px;
  border-radius: 2%;
  /* opacity: 0.2; */
  z-index: -1;
  text-align:center;
 
}
 .container{
		  	font-size: 12px;
		  	font-family: sans-serif;
		    
		  }
		 .id-1{
		  	transition: 0.4s;
		  	width:250px;
		  	height:450px;
		  	background: #FFFFFF;
		  	text-align:center;
		  	font-size: 16px;
		  	font-family: sans-serif;
		  	float: left;
		  	margin:auto;		  	
		  	margin-left:270px;
		  	border-radius:2%;

		  	
		  }
</style>
	</head>
<?php 
?>
	<body>
		<script type="text/javascript">	
 		
 	// window.print();
 </script>
      <div id="bg">
            <div id="id">
            	<table>
                    <tr style="margin-top:20px;">
                        <!-- <td>
                            <img style="margin-left: 7px;" src=<?php echo base_url()."assets/dist/assets/images/logo.png" ?> alt="Avatar"  width="70px" height="50px">
                        </td> -->
                        <td>
                            <h3 style="color:white; margin-top:20px; margin-left: 5px; text-align: center;"><b>MERAPI GOLF CLUB HOUSE</b></h3>
                        </td>
                    </tr>        
                </table>
                <center>
                    <img src=<?php echo base_url()."assets/dist/assets/images/logo.png" ?> alt="Avatar"  width="70px" height="70px">
      	<h2 style="color:#00BFFF;margin-left:2%"><?= $data['data']['result']->nama_member ? $data['data']['result']->nama_member : '' ?></h2>
                </center>
                    <div class="container" align="center">
                    
                        <p style="margin-top:2%; text-size: 15px;">No Telephone :</p>
                        <p style="font-weight: bold;margin-top:-4%"><?= $data['data']['result']->no_telp ? $data['data']['result']->no_telp : '' ?></p>
                        <p style="margin-top:-4%">Email :</p>
                        <p style="font-weight: bold;margin-top:-4%"><?= $data['data']['result']->email ? $data['data']['result']->email : '' ?></p>
                    <p style="margin-top:-4%">Status :</p>
                        <p style="font-weight: bold;margin-top:-4%"><?= $data['data']['result']->status_member ? $data['data']['result']->status_member : '' ?></p>
                        <!-- <p style="margin-top:-4%">DEPARTMENT:</p>
                        <p style="font-weight: bold;margin-top:-4%"><?php if(isset($dept)){ echo$dept;} ?></p>      	
                        <p style="margin-top:-4%">HOLDER SIGNATURE</p> -->
                        <hr align="center" style="border: 1px solid black;width:80%;margin-top:13%"></hr> 

      	<p align="center" style="margin-top: 5px">Contact Us</p>
          <!-- <p align="center" style="margin-top: 5px">marketingmerapigolf@gmail.com</p> -->
          <p style="margin-top:-4%">marketingmerapigolf@gmail.com</p>
          <p style="margin-top:-4%">(62 274) 896176</p>
          <!-- <p align="center" style="margin-top: 5px">(62 274) 896176</p> -->
          
                            
                    </div>
            </div>
            <div class="id-1">
    	 
                     	 <center><img style="margin-top: 70px; margin-bottom: 25px" src=<?php echo base_url()."assets/dist/assets/images/logo.png" ?> alt="Avatar" width="200px" height="175px" >        
       <div class="container" align="center">
      <p style="margin:auto">You Want to Play Golf</p>
      	<h2 style="color:#00BFFF;margin-left:2%">WE HAVE A PLACE TO PLAY GOLF </h2>
      <!-- <p style="margin:auto">If lost and found please return to the nearest police station</p>
        <hr align="center" style="border: 1px solid black;width:80%;margin-top:13%"></hr>  -->

      	<!-- <p align="center" style="margin-top:-2%">Authorized Signature</p>
      		<p> <?php if(isset($code)){ echo$code;}?>
      			</p>
      		 <?php if(isset($idsx)){ echo"Property of ".$idsx;}?> </center> -->
     </div>
</div>

        </div>
	</body>
</html>
