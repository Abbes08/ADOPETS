
<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Home Adopets</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <link href="https://fonts.googleapis.com/css?family=Montserrat:200,300,400,500,600,700,800&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
 
    <link rel="stylesheet" href="css/animate.css">
    
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="css/owl.theme.default.min.css">
    <link rel="stylesheet" href="css/magnific-popup.css">


    <link rel="stylesheet" href="css/bootstrap-datepicker.css">
    <link rel="stylesheet" href="css/jquery.timepicker.css">

    <link rel="stylesheet" href="css/flaticon.css">
    <link rel="stylesheet" href="css/style.css">
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  </head>
  <body>
 
   
		<nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
	    <div class="container">
    <a class="navbar-brand" href="{{ route('index') }}"><span class="flaticon-pawprint-1 mr-2"></span>Adopets</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="fa fa-bars"></span> Menu
    </button>
	<div class="collapse navbar-collapse" id="ftco-nav">
    <ul class="navbar-nav ml-auto">
        <li class="nav-item active"><a href="{{ route('index') }}" class="nav-link">Home</a></li>

        <li class="nav-item"><a href="{{ route('about') }}" class="nav-link">Preguntas Frecuentes</a></li>
        <li class="nav-item"><a href="{{ route('vet') }}" class="nav-link">Publicidad</a></li>
        <li class="nav-item"><a href="{{ route('services') }}" class="nav-link">Servicios</a></li>
        <li class="nav-item"><a href="{{ route('gallery') }}" class="nav-link">Mascotas</a></li>
		<li class="nav-item "><a href="{{ route('blog') }}" class="nav-link">Adopciones Exitosas</a></li>
        <li class="nav-item "><a href="{{ route('contact') }}" class="nav-link">Contactanos</a></li></li>
		@auth
    <li class="nav-item"><a href="{{ url('/home') }}" class="nav-link">Admin</a></li>
@endauth

@guest
    <li class="nav-item"><a href="{{ route('login') }}" class="nav-link">Login</a></li>
    @if (Route::has('register'))
        <li class="nav-item"><a href="{{ route('register') }}" class="nav-link">Registrate</a></li>
    @endif
@endguest



    </ul>
</div>


</div>
</nav>
<!-- END nav -->
<div class="hero-wrap js-fullheight" style="background-image: url('images/bg_1.jpg');" data-stellar-background-ratio="0.5">
    <div class="overlay"></div>
    <div class="container">
        <div class="row no-gutters slider-text js-fullheight align-items-center justify-content-center" data-scrollax-parent="true">
            <div class="col-md-11 ftco-animate text-center">
                <h1 class="mb-4">La mejor manera para adoptar se encuentra aquí</h1>
                
            </div>
        </div>
    </div>
</div>
    <section class="ftco-section bg-light ftco-no-pt ftco-intro">
    	<div class="container">
    		<div class="row">
          <div class="col-md-4 d-flex align-self-stretch px-4 ftco-animate">
            <div class="d-block services active text-center">
              <div class="icon d-flex align-items-center justify-content-center">
            		<span class="flaticon-blind"></span>
              </div>
              <div class="media-body">
                <h3 class="heading">Adopciones</h3>
                <p> Si deseas adoptar una mascota, ofrecemos una amplia variedad de animales que necesitan un hogar lleno de amor. Cada uno de ellos viene con información detallada para ayudarte a tomar la mejor decisión.</p>
                <a href="gallery" class="btn-custom d-flex align-items-center justify-content-center"><span class="fa fa-chevron-right"></span><i class="sr-only">Read more</i></a>
              </div>
            </div>      
          </div>
          <div class="col-md-4 d-flex align-self-stretch px-4 ftco-animate">
            <div class="d-block services text-center">
              <div class="icon d-flex align-items-center justify-content-center">
            		<span class="flaticon-dog-eating"></span>
              </div>
              <div class="media-body">
                <h3 class="heading">Dar en adopción</h3>
                <p>Te proporcionamos un formulario sencillo para compartir los detalles de tu mascota. Nos aseguramos de que sea visible para quienes buscan adoptar, ayudándote a encontrar un buen hogar para ella.</p>
                <a href="gallery" class="btn-custom d-flex align-items-center justify-content-center"><span class="fa fa-chevron-right"></span><i class="sr-only">Read more</i></a>
              </div>
            </div>    
          </div>
          <div class="col-md-4 d-flex align-self-stretch px-4 ftco-animate">
            <div class="d-block services text-center">
              <div class="icon d-flex align-items-center justify-content-center">
            		<span class="flaticon-grooming"></span>
              </div>
              <div class="media-body">
                <h3 class="heading">Publicidad</h3>
                <p>Aquí, clínicas veterinarias y doctores especializados pueden promover sus servicios, brindando la mejor atención para las mascotas. Si eres veterinario, este espacio es ideal para conectar con nuevos clientes y ofrecer tus servicios de cuidado animal.</p>
                <a href="vet" class="btn-custom d-flex align-items-center justify-content-center"><span class="fa fa-chevron-right"></span><i class="sr-only">Read more</i></a>
              </div>
            </div>      
          </div>
        </div>
    	</div>
    </section>

    <section class="ftco-section ftco-no-pt ftco-no-pb">
    	<div class="container">
    		<div class="row d-flex no-gutters">
    			<div class="col-md-5 d-flex">
    				<div class="img img-video d-flex align-self-stretch align-items-center justify-content-center justify-content-md-center mb-4 mb-sm-0" style="background-image:url(images/about-1.jpg);">
    				</div>
    			</div>
    			<div class="col-md-7 pl-md-5 py-md-5">
    				<div class="heading-section pt-md-5">
	            <h2 class="mb-4">Lo que ofrecemos</h2>
    				</div>
    				<div class="row">
	    				<div class="col-md-6 services-2 w-100 d-flex">
	    					<div class="icon d-flex align-items-center justify-content-center"><span class="flaticon-stethoscope"></span></div>
	    					<div class="text pl-3">
	    						<h4>Venta de Mascotas</h4>
	    						<p>Puedes comprar mascotas a través de nuestra plataforma, con la seguridad de que todos los animales cumplen con los estándares de salud y bienestar.</p>
	    					</div>
	    				</div>
	    				<div class="col-md-6 services-2 w-100 d-flex">
	    					<div class="icon d-flex align-items-center justify-content-center"><span class="flaticon-customer-service"></span></div>
	    					<div class="text pl-3">
	    						<h4>Adopciones</h4>
	    						<p>Ofrecemos un sistema ágil y confiable para adoptar una mascota que necesita un hogar amoroso.</p>
	    					</div>
	    				</div>
	    				<div class="col-md-6 services-2 w-100 d-flex">
	    					<div class="icon d-flex align-items-center justify-content-center"><span class="flaticon-emergency-call"></span></div>
	    					<div class="text pl-3">
	    						<h4>Dar en Adopción</h4>
	    						<p> Si por alguna razón no puedes seguir cuidando a tu mascota, te ofrecemos una plataforma segura para encontrarle un nuevo hogar.</p>
	    					</div>
	    				</div>
	    				<div class="col-md-6 services-2 w-100 d-flex">
	    					<div class="icon d-flex align-items-center justify-content-center"><span class="flaticon-veterinarian"></span></div>
	    					<div class="text pl-3">
	    						<h4>Servicio de Publicidad</h4>
	    						<p> Empresas o personas pueden promocionar productos y servicios relacionados con el mundo de las mascotas.</p>
	    					</div>
	    				</div>
	    			</div>
	        </div>
        </div>
    	</div>
    </section>

   

    <section class="ftco-section bg-light ftco-faqs">
    	<div class="container">
    		<div class="row">
    			<div class="col-lg-6 order-md-last">
    				<div class="img img-video d-flex align-self-stretch align-items-center justify-content-center justify-content-md-center mb-4 mb-sm-0" style="background-image:url(images/about.jpg);">
    					<a href="https://vimeo.com/45830194" class="icon-video popup-vimeo d-flex justify-content-center align-items-center">
    						<span class="fa fa-play"></span>
    					</a>
    				</div>
    				<div class="d-flex mt-3">
    					<div class="img img-2 mr-md-2" style="background-image:url(images/about-2.jpg);"></div>
    					<div class="img img-2 ml-md-2" style="background-image:url(images/about-3.jpg);"></div>
    				</div>
    			</div>

    			<div class="col-lg-6">
    				<div class="heading-section mb-5 mt-5 mt-lg-0">
	            <h2 class="mb-3">Preguntas frecuentes</h2>
	            <p>Este este apartado encontraras diferentes preguntas sobre nuestros servicios</p>
    				</div>
    				<div id="accordion" class="myaccordion w-100" aria-multiselectable="true">
						  <div class="card">
						    <div class="card-header p-0" id="headingOne">
						      <h2 class="mb-0">
						        <button href="#collapseOne" class="d-flex py-3 px-4 align-items-center justify-content-between btn btn-link" data-parent="#accordion" data-toggle="collapse" aria-expanded="true" aria-controls="collapseOne">
						        	<p class="mb-0">¿Qué debo saber antes de comprar una mascota en Adopets?</p>
						          <i class="fa" aria-hidden="true"></i>
						        </button>
						      </h2>
						    </div>
						    <div class="collapse show" id="collapseOne" role="tabpanel" aria-labelledby="headingOne">
						      <div class="card-body py-3 px-0">
						      	<ol>
						      		<li>Siempre es recomendable hablar directamente con el vendedor para conocer detalles sobre la salud, comportamiento y necesidades de la mascota.</li>
						      		<li>Asegúrate de que la mascota cuenta con toda la documentación necesaria, como certificados de salud o vacunación.</li>
						      		<li>Considera costos adicionales, como el transporte o los cuidados veterinarios futuros.</li>
						      		<li>Asegúrate de que el animal se adapta a tu entorno y disponibilidad de tiempo.</li>
						      		<li>Asegúrate de que el vendedor sea confiable y la mascota provenga de un ambiente saludable.</li>
						      	</ol>
						      </div>
						    </div>
						  </div>

						  <div class="card">
						    <div class="card-header p-0" id="headingTwo" role="tab">
						      <h2 class="mb-0">
						        <button href="#collapseTwo" class="d-flex py-3 px-4 align-items-center justify-content-between btn btn-link" data-parent="#accordion" data-toggle="collapse" aria-expanded="false" aria-controls="collapseTwo">
						        	<p class="mb-0">¿Qué debo tener en cuenta antes de adoptar una mascota en Adopets?</p>
						          <i class="fa" aria-hidden="true"></i>
						        </button>
						      </h2>
						    </div>
						    <div class="collapse" id="collapseTwo" role="tabpanel" aria-labelledby="headingTwo">
						      <div class="card-body py-3 px-0">
						      	<ol>
						      		<li>Adoptar una mascota implica una responsabilidad de cuidado durante toda su vida</li>
						      		<li>Asegúrate de que tu hogar tiene el espacio suficiente para la mascota que deseas adoptar.</li>
						      		<li>Considera los gastos en alimentación, cuidados veterinarios, y otros suministros para el bienestar de la mascota.</li>
						      		<li>Algunas mascotas requieren más interacción y tiempo que otras. Evalúa si puedes proporcionarle el tiempo necesario para su bienestar.</li>
						      		<li> Infórmate sobre las políticas de devolución y procesos de evaluación para asegurarte de que la mascota encaje bien en tu hogar.</li>
						      	</ol>
						      </div>
						    </div>
						  </div>

						  <div class="card">
						    <div class="card-header p-0" id="headingThree" role="tab">
						      <h2 class="mb-0">
						        <button href="#collapseThree" class="d-flex py-3 px-4 align-items-center justify-content-between btn btn-link" data-parent="#accordion" data-toggle="collapse" aria-expanded="false" aria-controls="collapseThree">
						        	<p class="mb-0">¿Qué debo saber antes de dar en adopción a mi mascota en Adopets?</p>
						          <i class="fa" aria-hidden="true"></i>
						        </button>
						      </h2>
						    </div>
						    <div class="collapse" id="collapseThree" role="tabpanel" aria-labelledby="headingTwo">
						      <div class="card-body py-3 px-0">
						      	<ol>
						      		<li>Debes proporcionar una descripción precisa de la mascota, incluyendo su personalidad, necesidades especiales y cualquier comportamiento relevante.</li>
						      		<li>Asegúrate de evaluar cuidadosamente a las personas interesadas en adoptar tu mascota para garantizar que encontrarán un hogar adecuado.</li>
						      		<li>En algunos casos, puedes optar por mantener contacto con el adoptante para verificar que la mascota se adapte bien.</li>
						      		<li>La adopción puede tomar tiempo. Asegúrate de ser paciente hasta encontrar el mejor hogar para tu mascota.</li>
						      		<li> Clarifica las condiciones bajo las cuales entregas la mascota, como qué accesorios o documentación se incluyen (comida, juguetes, historial veterinario, etc.).</li>
						      	</ol>
						      </div>
						    </div>
						  </div>

						  <div class="card">
						    <div class="card-header p-0" id="headingFour" role="tab">
						      <h2 class="mb-0">
						        <button href="#collapseFour" class="d-flex py-3 px-4 align-items-center justify-content-between btn btn-link" data-parent="#accordion" data-toggle="collapse" aria-expanded="false" aria-controls="collapseFour">
						        	<p class="mb-0">¿Qué debo considerar antes de anunciarme en el servicio de publicidad de Adopets?</p>
						          <i class="fa" aria-hidden="true"></i>
						        </button>
						      </h2>
						    </div>
						    <div class="collapse" id="collapseFour" role="tabpanel" aria-labelledby="headingTwo">
						      <div class="card-body py-3 px-0">
							  <ol>
						      		<li>La publicidad en Adopets está dirigida principalmente a personas interesadas en mascotas, por lo que es ideal para productos y servicios relacionados con el cuidado animal.</li>
						      		<li>Revisa las diferentes opciones de paquetes publicitarios que ofrecemos y elige el que mejor se ajuste a tus necesidades.</li>
						      		<li>Asegúrate de conocer cuánto tiempo estará visible tu anuncio y qué tipo de actualizaciones puedes hacer durante la campaña.</li>
						      		<li>Aprovecha la segmentación que ofrece la plataforma para asegurarte de que tu publicidad alcance al público más relevante.</li>
						      		
						      	</ol>
						      </div>
						    </div>
						  </div>
						</div>
	        </div>
        </div>
    	</div>
    </section>

    <section class="ftco-section testimony-section" style="background-image: url('images/bg_2.jpg');">
    	<div class="overlay"></div>
      <div class="container">
        <div class="row justify-content-center pb-5 mb-3">
          <div class="col-md-7 heading-section text-center ftco-animate">
            <h2>Apartado de Publicidad</h2>
          </div>
        </div>
        <div class="row ftco-animate">
          <div class="col-md-12">
            <div class="carousel-testimony owl-carousel ftco-owl">
              <div class="item">
                <div class="testimony-wrap py-4">
                	<div class="icon d-flex align-items-center justify-content-center"><span class="fa fa-quote-left"></span></div>
                  <div class="text">
                    <p class="mb-4">VetCare Integral ofrece servicios veterinarios para el cuidado preventivo y emergencias de tus mascotas. </p>
                    <div class="d-flex align-items-center">
                    	<div class="user-img" style="background-image: url(images/person_1.jpeg)"></div>
                    	<div class="pl-3">
		                    <p class="name">VetCare Integral</p>
		                    <span class="position">Servicios veterinarios completos.</span>
		                  </div>
	                  </div>
                  </div>
                </div>
              </div>
              <div class="item">
                <div class="testimony-wrap py-4">
                	<div class="icon d-flex align-items-center justify-content-center"><span class="fa fa-quote-left"></span></div>
                  <div class="text">
                    <p class="mb-4">MascotaFit te ofrece una amplia variedad de juguetes, correas, y accesorios para mantener a tu mascota activa y saludable</p>
                    <div class="d-flex align-items-center">
                    	<div class="user-img" style="background-image: url(images/person_2.jpg)"></div>
                    	<div class="pl-3">
		                    <p class="name">MascotaFitt</p>
		                    <span class="position">Productos y accesorios para el entrenamiento</span>
		                  </div>
	                  </div>
                  </div>
                </div>
              </div>
              <div class="item">
                <div class="testimony-wrap py-4">
                	<div class="icon d-flex align-items-center justify-content-center"><span class="fa fa-quote-left"></span></div>
                  <div class="text">
                    <p class="mb-4">Peludos Gourmet es la opción ideal si buscas alimentación saludable y nutritiva para tu mascota.</p>
                    <div class="d-flex align-items-center">
                    	<div class="user-img" style="background-image: url(images/person_3.jpeg)"></div>
                    	<div class="pl-3">
		                    <p class="name">Peludos Gourmet</p>
		                    <span class="position">Alimentos naturales y premium para mascotas.</span>
		                  </div>
	                  </div>
                  </div>
                </div>
              </div>
              <div class="item">
                <div class="testimony-wrap py-4">
                	<div class="icon d-flex align-items-center justify-content-center"><span class="fa fa-quote-left"></span></div>
                  <div class="text">
                    <p class="mb-4">Estética Felina & Canina ofrece servicios de peluquería, baño, y cortes especiales para perros y gatos. </p>
                    <div class="d-flex align-items-center">
                    	<div class="user-img" style="background-image: url(images/person_4.png)"></div>
                    	<div class="pl-3">
		                    <p class="name">Estética Felina & Canina</p>
		                    <span class="position">Servicios de peluquería y cuidado estético para mascotas</span>
		                  </div>
	                  </div>
                  </div>
                </div>
              </div>
              <div class="item">
                <div class="testimony-wrap py-4">
                	<div class="icon d-flex align-items-center justify-content-center"><span class="fa fa-quote-left"></span></div>
                  <div class="text">
                    <p class="mb-4">PetTravel es la solución perfecta para transportar a tu mascota de manera cómoda y segura, ya sea para mudanzas, vacaciones o visitas al veterinario</p>
                    <div class="d-flex align-items-center">
                    	<div class="user-img" style="background-image: url(images/persona_5.png)"></div>
                    	<div class="pl-3">
		                    <p class="name">PetTravel</p>
		                    <span class="position">Servicios de transporte seguro para mascotas</span>
		                  </div>
	                  </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

   
		
		<section class="ftco-section">
			<div class="container">
				<div class="row justify-content-center pb-5 mb-3">
          <div class="col-md-7 heading-section text-center ftco-animate">
            <h2>Galeria de mascotas</h2>
          </div>
        </div>
				<div class="row">
          <div class="col-md-4 ftco-animate">
            <div class="work mb-4 img d-flex align-items-end" style="background-image: url(images/gallery-1.jpg);">
            	<a href="images/gallery-1.jpg" class="icon image-popup d-flex justify-content-center align-items-center">
	    					<span class="fa fa-expand"></span>
	    				</a>
            	<div class="desc w-100 px-4">
	              <div class="text w-100 mb-3">
	              	<span>Gato</span>
	              	<h2><a href="work-single.html">Gato Persa </a></h2>
	              </div>
              </div>
            </div>
          </div>
          <div class="col-md-4 ftco-animate">
            <div class="work mb-4 img d-flex align-items-end" style="background-image: url(images/gallery-2.jpg);">
            	<a href="images/gallery-2.jpg" class="icon image-popup d-flex justify-content-center align-items-center">
	    					<span class="fa fa-expand"></span>
	    				</a>
            	<div class="desc w-100 px-4">
	              <div class="text w-100 mb-3">
	              	<span>Perro</span>
	              	<h2><a href="work-single.html">Pomeranian</a></h2>
	              </div>
              </div>
            </div>
          </div>
          <div class="col-md-4 ftco-animate">
            <div class="work mb-4 img d-flex align-items-end" style="background-image: url(images/gallery-3.jpg);">
            	<a href="images/gallery-3.jpg" class="icon image-popup d-flex justify-content-center align-items-center">
	    					<span class="fa fa-expand"></span>
	    				</a>
            	<div class="desc w-100 px-4">
	              <div class="text w-100 mb-3">
	              	<span>Gato</span>
	              	<h2><a href="work-single.html">Sphynx Cat</a></h2>
	              </div>
              </div>
            </div>
          </div>

          <div class="col-md-4 ftco-animate">
            <div class="work mb-4 img d-flex align-items-end" style="background-image: url(images/gallery-4.jpg);">
            	<a href="images/gallery-4.jpg" class="icon image-popup d-flex justify-content-center align-items-center">
	    					<span class="fa fa-expand"></span>
	    				</a>
            	<div class="desc w-100 px-4">
	              <div class="text w-100 mb-3">
	              	<span>Gato</span>
	              	<h2><a href="work-single.html">British Shorthair</a></h2>
	              </div>
              </div>
            </div>
          </div>
          <div class="col-md-4 ftco-animate">
            <div class="work mb-4 img d-flex align-items-end" style="background-image: url(images/gallery-5.jpg);">
            	<a href="images/gallery-5.jpg" class="icon image-popup d-flex justify-content-center align-items-center">
	    					<span class="fa fa-expand"></span>
	    				</a>
            	<div class="desc w-100 px-4">
	              <div class="text w-100 mb-3">
	              	<span>Perro</span>
	              	<h2><a href="work-single.html">Beagle</a></h2>
	              </div>
              </div>
            </div>
          </div>
          <div class="col-md-4 ftco-animate">
            <div class="work mb-4 img d-flex align-items-end" style="background-image: url(images/gallery-6.jpg);">
            	<a href="images/gallery-6.jpg" class="icon image-popup d-flex justify-content-center align-items-center">
	    					<span class="fa fa-expand"></span>
	    				</a>
            	<div class="desc w-100 px-4">
	              <div class="text w-100 mb-3">
	              	<span>Perro</span>
	              	<h2><a href="work-single.html">Pug</a></h2>
	              </div>
              </div>
            </div>
          </div>
        </div>
			</div>
		</section>

    <section class="ftco-section bg-light">
      <div class="container">
        <div class="row justify-content-center pb-5 mb-3">
          <div class="col-md-7 heading-section text-center ftco-animate">
            <h2>Ultimas Adopciones Exitosas</h2>
          </div>
        </div>
        <div class="row d-flex">
          <div class="col-md-4 d-flex ftco-animate">
            <div class="blog-entry align-self-stretch">
              <a href="blog-single.html" class="block-20 rounded" style="background-image: url('images/image_1.jpg');">
              </a>
			  <div class="text p-4">
              	<div class="meta mb-2">
                  <div><a href="#">April 07, 2020</a></div>
                  <div><a href="#">Admin</a></div>
                  <div><a href="#" class="meta-chat"><span class="fa fa-comment"></span> 3</a></div>
                </div>
                <h3 class="heading"><a href="#">"Adoptar a Luna fue la mejor decisión que tomé. Gracias a Adopets, el proceso fue muy fácil y transparente. Ahora Luna es parte de nuestra familia, y no podríamos estar más felices con ella."</a></h3>
              </div>
            </div>
          </div>
          <div class="col-md-4 d-flex ftco-animate">
            <div class="blog-entry align-self-stretch">
              <a href="blog-single.html" class="block-20 rounded" style="background-image: url('images/image_2.jpg');">
              </a>
              <div class="text p-4">
              	<div class="meta mb-2">
                  <div><a href="#">April 07, 2020</a></div>
                  <div><a href="#">Admin</a></div>
                  <div><a href="#" class="meta-chat"><span class="fa fa-comment"></span> 3</a></div>
                </div>
                <h3 class="heading"><a href="#">"Adoptamos a Max hace un par de meses, y ha sido una experiencia increíble. La plataforma me permitió conocer todos los detalles importantes sobre él antes de adoptarlo, lo que me dio mucha confianza. ¡Max está feliz y nosotros también!"</a></h3>
              </div>
            </div>
          </div>
          <div class="col-md-4 d-flex ftco-animate">
            <div class="blog-entry align-self-stretch">
              <a href="blog-single.html" class="block-20 rounded" style="background-image: url('images/image_3.jpg');">
              </a>
              <div class="text p-4">
              	<div class="meta mb-2">
                  <div><a href="#">April 07, 2020</a></div>
                  <div><a href="#">Admin</a></div>
                  <div><a href="#" class="meta-chat"><span class="fa fa-comment"></span> 3</a></div>
                </div>
                <h3 class="heading"><a href="#">"Adopets me ayudó a encontrar a Rocky, un perrito adorable que necesitaba un hogar. El proceso fue rápido y sencillo, y lo mejor fue que pude contactar al antiguo dueño para conocer más sobre su historia. ¡Estamos encantados!"</a></h3>
              </div>
            </div>
          </div>
          </div>
        </div>
      </div>
    </section>

<!-- FORMULARIO CONSULTAS GRATUITAS 


    <section class="ftco-appointment ftco-section ftco-no-pt ftco-no-pb img" style="background-image: url(images/bg_3.jpg);">
			<div class="overlay"></div>
    	<div class="container">
    		<div class="row d-md-flex justify-content-end">
    			<div class="col-md-12 col-lg-6 half p-3 py-5 pl-lg-5 ftco-animate">
    				<h2 class="mb-4">Free Consultation</h2>
    				<form action="#" class="appointment">
    					<div class="row">
    						<div class="col-md-12">
									<div class="form-group">
			    					<div class="form-field">
	          					<div class="select-wrap">
	                      <div class="icon"><span class="fa fa-chevron-down"></span></div>
	                      <select name="" id="" class="form-control">
	                      	<option value="">Select services</option>
	                        <option value="">Cat Sitting</option>
	                        <option value="">Dog Walk</option>
	                        <option value="">Pet Spa</option>
	                        <option value="">Pet Grooming</option>
	                        <option value="">Pet Daycare</option>
	                      </select>
	                    </div>
			              </div>
			    				</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
			              <input type="text" class="form-control" placeholder="Your Name">
			            </div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
			              <input type="text" class="form-control" placeholder="Vehicle number">
			            </div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
			    					<div class="input-wrap">
			            		<div class="icon"><span class="fa fa-calendar"></span></div>
			            		<input type="text" class="form-control appointment_date" placeholder="Date">
		            		</div>
			    				</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
			    					<div class="input-wrap">
			            		<div class="icon"><span class="fa fa-clock-o"></span></div>
			            		<input type="text" class="form-control appointment_time" placeholder="Time">
		            		</div>
			    				</div>
								</div>
								<div class="col-md-12">
									<div class="form-group">
			              <textarea name="" id="" cols="30" rows="7" class="form-control" placeholder="Message"></textarea>
			            </div>
								</div>
								<div class="col-md-12">
									<div class="form-group">
			              <input type="submit" value="Send message" class="btn btn-primary py-3 px-4">
			            </div>
								</div>
    					</div>
	          </form>
    			</div>
    		</div>
    	</div>
    </section>
-->
    <footer class="footer">
			<div class="container">
				<div class="row">
					<div class="col-md-6 col-lg-3 mb-4 mb-md-0">
						<h2 class="footer-heading">Redes Sociales</h2>
						<p>Encuéntranos en nuestras redes sociales y se parte de la familia Adopets</p>
						<ul class="ftco-footer-social p-0">
              <li class="ftco-animate"><a href="#" data-toggle="tooltip" data-placement="top" title="Twitter"><span class="fa fa-twitter"></span></a></li>
              <li class="ftco-animate"><a href="#" data-toggle="tooltip" data-placement="top" title="Facebook"><span class="fa fa-facebook"></span></a></li>
              <li class="ftco-animate"><a href="#" data-toggle="tooltip" data-placement="top" title="Instagram"><span class="fa fa-instagram"></span></a></li>
            </ul>
					</div>
					<div class="col-md-6 col-lg-3 mb-4 mb-md-0">
						<h2 class="footer-heading">Últimas Noticias</h2>
						<div class="block-21 mb-4 d-flex">
              <a class="img mr-4 rounded" style="background-image: url(images/image_1.jpg);"></a>
              <div class="text">
                <h3 class="heading"><a href="#">Tengo la mejor mascota, gracias a Adopets</a></h3>
                <div class="meta">
                  <div><a href="#"><span class="icon-calendar"></span> April 7, 2020</a></div>
                  <div><a href="#"><span class="icon-person"></span> Admin01</a></div>
                  <div><a href="#"><span class="icon-chat"></span> 19</a></div>
                </div>
              </div>
            </div>
            <div class="block-21 mb-4 d-flex">
              <a class="img mr-4 rounded" style="background-image: url(images/image_2.jpg);"></a>
              <div class="text">
                <h3 class="heading"><a href="#">Sam es una mascota increible</a></h3>
                <div class="meta">
                  <div><a href="#"><span class="icon-calendar"></span> April 7, 2020</a></div>
                  <div><a href="#"><span class="icon-person"></span> Admin</a></div>
                  <div><a href="#"><span class="icon-chat"></span> 19</a></div>
                </div>
              </div>
            </div>
					</div>
					<div class="col-md-6 col-lg-3 pl-lg-5 mb-4 mb-md-0">
						<h2 class="footer-heading">Links del Sistema</h2>
						<ul class="list-unstyled">
              <li><a href="#" class="py-2 d-block">Home</a></li>
              <li><a href="#" class="py-2 d-block">Preguntas Frecuentes</a></li>
              <li><a href="#" class="py-2 d-block">Publicidad</a></li>
              <li><a href="#" class="py-2 d-block">Servicios</a></li>
              <li><a href="#" class="py-2 d-block">Mascotas</a></li>
              <li><a href="#" class="py-2 d-block">Adopciones exitosas</a></li>
			  <li><a href="#" class="py-2 d-block">Contáctanos</a></li>
            </ul>
					</div>
					<div class="col-md-6 col-lg-3 mb-4 mb-md-0">
						<h2 class="footer-heading">¿Tienes alguna pregunta?</h2>
						<div class="block-23 mb-3">
              <ul>
                <li><span class="icon fa fa-map"></span><span class="text">650 metros suroeste de la Cruz Roja, Nicoya, Guanacaste</span></li>
                <li><a href="#"><span class="icon fa fa-phone"></span><span class="text">+506 83868587</span></a></li>
                <li><a href="#"><span class="icon fa fa-paper-plane"></span><span class="text">adopets@gmail.com</span></a></li>
              </ul>
            </div>
					</div>
				</div>
				
		</footer>

    
  

  <!-- loader -->
  <div id="ftco-loader" class="show fullscreen"><svg class="circular" width="48px" height="48px"><circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee"/><circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#F96D00"/></svg></div>


  <script src="js/jquery.min.js"></script>
  <script src="js/jquery-migrate-3.0.1.min.js"></script>
  <script src="js/popper.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/jquery.easing.1.3.js"></script>
  <script src="js/jquery.waypoints.min.js"></script>
  <script src="js/jquery.stellar.min.js"></script>
  <script src="js/jquery.animateNumber.min.js"></script>
  <script src="js/bootstrap-datepicker.js"></script>
  <script src="js/jquery.timepicker.min.js"></script>
  <script src="js/owl.carousel.min.js"></script>
  <script src="js/jquery.magnific-popup.min.js"></script>
  <script src="js/scrollax.min.js"></script>
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBVWaKrjvy3MaE7SQ74_uJiULgl1JY0H2s&sensor=false"></script>
  <script src="js/google-map.js"></script>
  <script src="js/main.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>



    
  </body>
</html>