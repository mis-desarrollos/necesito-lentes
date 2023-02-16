<template lang="html">
  <div>
    <!-- Paso 1 -->
    <div class="box-step-wr" v-if="$parent.step == 1 && !showInfoForm">
      <div class="wr">
        <h2 class="mb-4 h1s f-w-800 txt-blue">¿Conoces tu graduación?</h2>

        <div class="d-block pb-5">
          <b-button type="submit" class="btn btn-lg btn-s1 bg-blue" @click="$parent.form.graduacion = 'no'">Si</b-button>

          <p class="mt-3 h4 f-w-600 txt-white">Sube tus datos</p>
        </div>

        <div>
          <b-button type="submit" class="btn btn-lg btn-s1 bg-blue" @click="$parent.form.graduacion = 'no'; showInfoForm = true">No</b-button>

          <p class="mt-3 h4 f-w-600 txt-white">Comienza el proceso de mandar a hacer tus lentes con nosotros y pedir que un profesional te realice el examen gratuito.</p>
        </div>
      </div>
    </div>
    <!--  -->

    <!-- Formulario "NO" del paso 1 -->
    <div class="box-step-wr" v-if="showInfoForm">
      <div class="wr">
        <div class="row justify-content-center">
          <h2 class="mb-4 h1s f-w-800 txt-blue">Agrega tu información</h2>

          <div class="col-lg-7">
            <b-form-group label="1. Esta es una pregunta para la parte de información" class="custom-radio-group form-group-qa" v-slot="{ ariaDescribedby }">
              <b-form-radio-group
                required
                v-model="$parent.form.misdatos.pregunta1"
                :aria-describedby="ariaDescribedby"
                name="rad-1">
                <b-form-radio value="1">Esta es la respuesta numero 1</b-form-radio>
                <b-form-radio value="2">Esta es la respuesta numero 2</b-form-radio>
                <b-form-radio value="3">Esta es la respuesta numero 3</b-form-radio>
              </b-form-radio-group>
            </b-form-group>

            <b-form-group label="2. Esta es otra pregunta para la parte de información" class="custom-radio-group form-group-qa" v-slot="{ ariaDescribedby }">
              <b-form-radio-group
                required
                v-model="$parent.form.misdatos.pregunta2"
                :aria-describedby="ariaDescribedby"
                name="rad-2">
                <b-form-radio value="1">Esta es la respuesta numero 1</b-form-radio>
                <b-form-radio value="2">Esta es la respuesta numero 2</b-form-radio>
                <b-form-radio value="3">Esta es la respuesta numero 3</b-form-radio>
              </b-form-radio-group>
            </b-form-group>

            <b-form-group label="3. Esta es la tercer pregunta para la parte de información" class="custom-radio-group form-group-qa" v-slot="{ ariaDescribedby }">
              <b-form-radio-group
                required
                v-model="$parent.form.misdatos.pregunta3"
                :aria-describedby="ariaDescribedby"
                name="rad-3">
                <b-form-radio value="1">Esta es la respuesta numero 1</b-form-radio>
                <b-form-radio value="2">Esta es la respuesta numero 2</b-form-radio>
                <b-form-radio value="3">Esta es la respuesta numero 3</b-form-radio>
              </b-form-radio-group>
            </b-form-group>

            <b-form-group label="4. Esta es una cuarta pregunta para la parte de información" class="custom-radio-group form-group-qa" v-slot="{ ariaDescribedby }">
              <b-form-radio-group
                required
                v-model="$parent.form.misdatos.pregunta4"
                :aria-describedby="ariaDescribedby"
                name="rad-4">
                <b-form-radio value="1">Esta es la respuesta numero 1</b-form-radio>
                <b-form-radio value="2">Esta es la respuesta numero 2</b-form-radio>
                <b-form-radio value="3">Esta es la respuesta numero 3</b-form-radio>
              </b-form-radio-group>
            </b-form-group>

            <p>
              <b-button type="submit" class="btn btn-lg btn-s1 bg-blue">Guardar</b-button>
            </p>
          </div>
        </div>
      </div>
    </div>
    <!--  -->
  </div>

</template>

<script>
export default {
  data() {
    return {
      showInfoForm: false,
    }
  }
}
</script>
