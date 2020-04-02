<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <title>Hello, world!</title>
  </head>
  <body>

	<div class="container">
    <h1>Hello, world!</h1>

	<form action="biasach.php" method="get">
	  <div class="form-group">
	    <label for="InputTp">Tên tác phẩm</label>
	    <input type="tp" name="tp" class="form-control" id="InputTp" aria-describedby="TpHelp">
	    <small id="TpHelp" class="form-text text-muted">Ngắt dòng bằng \n</small>
	  </div>
	  <div class="form-group">
	    <label for="InputTg">Tên tác giả</label>
	    <input type="tg" name="tg" class="form-control" id="InputTg">
	  </div>
	  <button type="submit" class="btn btn-primary">Tạo bìa</button>
	</form>
	<div class="mb-5"></div>
	<p class="text-monospace">Sử dụng nhanh bằng biasach.php?tg=Tác giả hoặc bỏ trống&tp=Tác phẩm hoặc Tác\nPhẩm để ngắt dòng</p>
	<p class="text-monospace">Hỗ trợ tốt cho Tiếng Việt</p>

	</div>

  </body>
</html>