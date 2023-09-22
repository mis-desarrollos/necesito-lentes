<template lang="html">
  <div id="contact-v2-page">

    <section class="contact-section">
      <div class="box-titles">
        <h2 class="title-h1">Contacto</h2>

        <h5 class="title-2">Envía tus dudas y sugerencias</h5>

        <p class="mt-3 mt-sm-2 txt-info">
          Un asesor se pondrá en contacto contigo lo antes posible.
        </p>
      </div>

      <div class="box-form">
        <b-form @submit="onSubmit">
          <b-form-group class="custom-f-group-s1">
            <b-form-input
              v-model="form.name"
              type="text"
              placeholder="Nombre"
              size="lg"
              required
            ></b-form-input>
          </b-form-group>

          <b-form-group class="custom-f-group-s1">
            <b-form-input
              v-model="form.phone"
              type="text"
              placeholder="Teléfono"
              minlength="10"
              maxlength="10"
              size="lg"
              required
            ></b-form-input>
          </b-form-group>

          <b-form-group class="custom-f-group-s1">
            <b-form-input
              v-model="form.email"
              type="email"
              placeholder="Correo electrónico"
              size="lg"
              required
            ></b-form-input>
          </b-form-group>

          <b-form-group class="custom-f-group-s1">
            <b-form-input
              v-model="form.company"
              type="text"
              placeholder="Empresa"
              size="lg"
              required
            ></b-form-input>
          </b-form-group>

          <b-form-group class="custom-f-group-s1">
            <b-form-textarea
              v-model="form.msg"
              placeholder="Mensaje"
              rows="4"
              max-rows="4"
              size="lg"
              required
            ></b-form-textarea>
          </b-form-group>

          <p class="pt-2 text-center">
            <b-button type="submit" class="btn-s2">Enviar mensaje</b-button>
          </p>
        </b-form>
      </div>

      <div class="box-image" v-bind:style="{ backgroundImage: 'url(public/images/pages/home/h-glasses-3.jpg)' }">
        <!-- <img src="public/images/pages/home/h-glasses-3.png"> -->
      </div>
    </section>

    <section class="contact-section">
      <div class="box-titles">
        <h2 class="title-h1">¿Tienes<br />una óptica?</h2>

        <h5 class="title-2">Afíliate con nosotros</h5>
      </div>

      <div class="box-form">
        <b-form @submit="onSubmitAf">
          <b-form-group class="custom-f-group-s1">
            <b-form-input
              v-model="formAf.name"
              type="text"
              placeholder="Nombre"
              size="lg"
              required
            ></b-form-input>
          </b-form-group>

          <b-form-group class="custom-f-group-s1">
            <b-form-input
              v-model="formAf.phone"
              type="text"
              placeholder="Teléfono"
              minlength="10"
              maxlength="10"
              size="lg"
              required
            ></b-form-input>
          </b-form-group>

          <b-form-group class="custom-f-group-s1">
            <b-form-input
              v-model="formAf.email"
              type="email"
              placeholder="Correo electrónico"
              size="lg"
              required
            ></b-form-input>
          </b-form-group>

          <p class="pt-2 text-center">
            <b-button type="submit" class="btn-s2">Afíliate con nosotros</b-button>
          </p>
        </b-form>
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
        form: null,
        email: null,
        company: null,
        msg: null,
      },

      formAf: {
        name: null,
        form: null,
        email: null,
      },
    }
  },

  methods: {
    onSubmit(event) {
      event.preventDefault();
    },

    onSubmitAf(event) {
      event.preventDefault();
    },
  },
}
</script>
