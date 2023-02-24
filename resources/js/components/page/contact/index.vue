<template lang="html">
  <div id="contact-page">

    <section class="container main-section">
      <div class="row align-items-center">
        <div class="col-12 col-title">
          <h1 class="title-s1">Contacto</h1>
        </div>

        <div class="col-lg-6 col-info">
          <h5 class="title">¿Tienes preguntas?<br />Envíanos un mensaje o comunicate con nosotros.</h5>

          <h5 class="mt-3 subtitle">Dirección Matriz</h5>
          <p>
            Calle 1 #123<br />
            Guadalajara, Jalisco<br />
            México.
          </p>

          <h5 class="mt-3 subtitle">Teléfono</h5>
          <p>
            Tel. 55 323-4332-9438
          </p>

          <h5 class="mt-3 subtitle">Correo</h5>
          <p>
            contacto@necesitolentes.club
          </p>

          <h5 class="mt-3 subtitle">Síguenos</h5>
          <p>
            <a class="btn-network mr-1" href=""><i class="fab fa-instagram"></i></a>
            <a class="btn-network ml-1" href=""><i class="fab fa-twitter"></i></a>
            <a class="btn-network ml-1" href=""><i class="fab fa-facebook-f"></i></a>
            <!-- <a class="btn-network ml-1" href="#"><i class="fab fa-linkedin-in"></i></a> -->
          </p>
        </div>

        <div class="col-lg-6 col-form">
          <b-form @submit="onSubmit">
            <b-form-group class="custom-form-group-s1" label="Nombre completo">
              <b-form-input type="text" size="sm" v-model="form.name" required placeholder=""></b-form-input>
            </b-form-group>

            <b-form-group class="custom-form-group-s1" label="Correo electrónico">
              <b-form-input type="email" size="sm" v-model="form.email" required placeholder=""></b-form-input>
            </b-form-group>

            <b-form-group class="custom-form-group-s1" label="Teléfono">
              <b-form-input type="text" size="sm" v-model="form.phone" minlength="10" maxlength="10" required placeholder=""></b-form-input>
            </b-form-group>

            <b-form-group class="custom-form-group-s1" label="Mensaje">
              <b-form-textarea
                required
                v-model="form.msg"
                size="sm"
                placeholder=""
                rows="4"
                max-rows="4"
              ></b-form-textarea>
            </b-form-group>

            <p class="text-right">
              <b-button type="submit" class="btn-s1 bg-blue">ENVIAR</b-button>
            </p>
          </b-form>
        </div>
      </div>
    </section>

  </div>
</template>

<script>
export default {
  data(){
    return{
      form: {
        name: null,
      }
    }
  },

  methods: {
    onSubmit(event) {
      event.preventDefault();
    }
  },
}
</script>
