<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RapiCestas - Gerenciar Produtos</title>

    <link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css" />
    <link rel="icon" href="/image/cesta.png" >

    <link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css" />

    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <!-- custom css file link  -->
    <link rel="stylesheet" href="/css/style.css">

 

</head>
<body>
    
<!-- header section starts  -->


<header class="header">

    <a href="/" class="logo"><img src="/image/logo1.png" alt="" style = "width : 100px;"></a>

    <nav class="navbar">
        <a href="/">home</a>
        <a href="produtos">produtos</a>
       
      
     
    </nav>

    <div class="icons">
        <div class="fas fa-bars" id="menu-btn"></div>
        <div class="fas fa-search" id="search-btn"></div>
       
        @if(Auth::check())

<a href="desejos"><div class="fas fa-heart" id="heart-btn"></div></a>
@else
@endif
        <div class="fas fa-user" id="login-btn">


        @if(Auth::check())
       
        <form action="" method="POST" class ="login-form">

            <h3>{{Auth::user()-> name}}</h3>
            <p>
            <a href="user/profile"> Gerenciar perfil</a>
            </p>
            <p>
            <a href="cadastro"> Cadastrar Produto</a>
            </p>

         

            <p>
            <a method="POST" href="gerenciar"> Gerenciar Produtos
            </a>
            </p>
            
            
        @if($user ['role_as'] === 1)
            <p>
            <a href="Aprovar-produtos"> Aprovar Produtos</a>
            </p>


        @else
        @endif
        

        </form>
        


        @else

        <form action="" class ="login-form">
        <p>
            Ainda n??o tem uma Conta?
            <a href="register"> Criar</a>
            </p>
            <p>
            J?? tem uma Conta?
            <a href="login">Login</a>
            </p>

        </form>

@endif
        </div>
        
    </div>


        <form  class="search-form" action="{{url('search')}}" method="GET" role="search">
        <input type="search" id="search-box" name="search" placeholder="search here...">

    </form>

</header>
<!-- header section ends -->

<!-- home section starts  -->

<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>


<!-- features section ends -->

<!-- products section starts  -->

<section class="products" id="products"  style = "min-height: 80vh;">

    <h1 class="heading"> Produtos <span> Registrados</span> </h1>

  
    <div class="swiper product-slider">

        <div class="swiper-wrapper">

    
        @foreach($produtos as $produto)
            <div class="swiper-slide box">

            <form action="/aprovar-produtos/{{$produto -> id}}" method ="post">
            @csrf
            @method('PUT')  


            <img src="/image/produtos/{{$produto ->image}}" alt="">

         
            <div class="content">
            <div class="user-details">

<div class="input-box">    
    
<input  type="text" name="nome" value="{{$produto -> nome}}" required>

</div>

                
                
<div class="input-box">

<input id="valor" type="text" value="{{$produto -> valor}}" name="valor" placeholder="R$ 0,00"  required>

</div>

               
                
<div class="input-box">

    <div class="select">    

        <select name="estado" value="{{$produto -> estado}}" id="estado">

        <option>Selecione o Estado</option>

          <option></option>

        </select>

    </div>

</div>


<div class="input-box">



    <div class="select">    

        <select name="cidade" value="{{$produto -> cidade}}" id="cidade">

        <option >Seleciona a Cidade</option>

         <option></option>

        </select>

    </div>

</div>

              

           
<div class="input-box">

<div class="select">
<select name="categoria" value="{{$produto-> categoria}}"  id="cidade">

<option value="Cesta B??sica" {{ $produto->categoria == 'Cesta B??sica' ? "selected='selected'" : "" }}>Cesta B??sica</option>
<option value="Perec??veis" {{ $produto->categoria == 'Perec??veis' ? "selected='selected'" : "" }}>Perec??veis</option>
 <option value="N??o Perec??veis" {{ $produto->categoria == 'N??o Perec??veis' ? "selected='selected'" : "" }}>N??o Perec??veis</option>

</select>
 </div>
 </div>


               
               
<div class="input-box">


<input type="text" name="contato" value="{{$produto-> contato}}"  required>

</div>

               
<div class="input-box">

<div class="select" value="{{$produto-> vendadoe}}">
<select name="vendadoe" id="cidade">

<option value="Venda" {{ $produto->vendadoe == 'Venda' ? "selected='selected'" : "" }}>Venda</option>
<option value="Doa????o" {{ $produto->categoria == 'Doa????o' ? "selected='selected'" : "" }}>Doa????o</option>
 

</select>
 </div>
 </div>
              

                <div style = "display: none;">
                <input type="text" name ="apr" value="{{0}}" >
                </div>
<br>
                <button class="btn">Editar</button>

                </div>
                <form></form>
                </div>
                </div>
           
@endforeach

        </div>

    </div>

</section>



<section class="products" id="products">

    <h1 class="heading"> Produtos <span> Aprovados </span></h1>
    @if(count($produtos) > 0)


    <div class="swiper product-slider">

        <div class="swiper-wrapper">


        @foreach($produtos -> where ('apr', 1) as $produto)
            <div class="swiper-slide box">
                <img src="/image/produtos/{{$produto ->image}}" alt="">
                <h3>{{ $produto -> nome}}</h3>

                <div class="price"> {{ $produto-> valor}} </div>

                <div class="price"
                > {{ $produto-> estado}} <a>-
                    
                </a> {{ $produto -> cidade}}</div>

              

                <div class="price"> <a>Categoria - </a>{{ $produto ->categoria}} </div>

                <div class="price"> <a>Contato - </a>{{ $produto ->contato}} </div>

                <div class="price"> <a>  </a>{{ $produto ->vendadoe}} </div>

                
                </form>
                <form action="/produtos/{{$produto->id}}" method ="POST">

                    @csrf
                    @method('DELETE')
                    
                    <button type ="submit" style ="background-color:white;">
                    <a class="btn">Deletar</a>

                    </button>
                </form>
               
               
            </div>
@endforeach
      
           

        </div>
@else
<h1>

</h1>
@endif
    </div>

    
  

    </div>

</section>


<!-- products section ends -->

<!-- categories section starts  -->



<!-- categories section ends -->

<!-- review section starts  -->



<!-- review section ends -->

<!-- blogs section starts  -->



<!-- blogs section ends -->

<!-- footer section starts  -->

<section class="footer">

    <div class="box-container">

        <div class="box">
        <a href="#" class="logo"><img src="/image/logo1.png" alt="" style = "width : 100px;"></a>
            <p>Tem Uma Cesta B??sica Ou Algum Alimento Sobrando Em Casa? Aqui Voc?? Pode Vender, Doar E At?? Mesmo Comprar Alimentos.</p>
            <div class="share">
                <a href="https://www.instagram.com/rapicestas/" target="_blank" class="fab fa-instagram"></a>
                <a href="#" class="fab fa-linkedin"></a>
            </div>
        </div>

        <div class="box">
            <h3>Contato</h3>
            <a href="#" class="links"> <i class="fas fa-phone"></i> +55 11 982493127 </a>
            <a href="#" class="links"> <i class="fas fa-phone"></i> +55 11 954496921     </a>
            <a href="#" class="links"> <i class="fas fa-envelope"></i> rapicestas@gmail.com </a>
            <a href="#" class="links"> <i class="fas fa-map-marker-alt"></i> S??o Bernardo do Campo, SP - 09750-000 </a>
        </div>

        <div class="box">
            <h3>Links</h3>
            <a href="#" class="links"> <i class="fas fa-arrow-right"></i> home </a>
            <a href="#features" class="links"> <i class="fas fa-arrow-right"></i> sobre </a>
            <a href="#products" class="links"> <i class="fas fa-arrow-right"></i> produtos </a>
 
           
        </div>

       
    </div>

 
</section>

<!-- footer section ends -->















<script src="https://unpkg.com/swiper@7/swiper-bundle.min.js"></script>

<!-- custom js file link  -->
<script src="js/script.js"></script>

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js" type="text/javascript"></script>
<script src="https://plentz.github.io/jquery-maskmoney/javascripts/jquery.maskMoney.min.js" type="text/javascript"></script>
<script src="js/cidades.js" type="text/javascript"></script>


<script>
 const realFileBtn = document.getElementById("real-file");
const customBtn = document.getElementById("custom-button");
const customTxt = document.getElementById("custom-text");

customBtn.addEventListener("click", function() {
  realFileBtn.click();
});

realFileBtn.addEventListener("change", function() {
  if (realFileBtn.value) {
    customTxt.innerHTML = realFileBtn.value.match(
      /[\/\\]([\w\d\s\.\-\(\)]+)$/
    )[1];
  } else {
    customTxt.innerHTML = "No file chosen, yet.";
  }
});

</script>

  <script>
jQuery(function() {
    
    jQuery("#valor").maskMoney({
	prefix:'R$ ', 
	thousands:'.', 
	decimal:','
})

});
</script>

</body>
</html>