<template lang="html">
<div>
  <b-form @submit.prevent="onSubmit()">
    <h6>Datos de personales</h6>
    <hr class="c-hr" />

    <b-form-group class="custom-input" label="Nombre:" label-for="i-nombre">
      <b-form-input id="i-nombre" type="text" v-model="$root.user.name" size="sm" required placeholder="Escriba su nombre" />
    </b-form-group>

    <b-form-group class="custom-input" label="Apellidos:" label-for="i-lastname">
      <b-form-input id="i-lastname" type="text" v-model="$root.user.lastname" size="sm" required placeholder="Escriba sus apellidos" />
    </b-form-group>

    <b-form-group class="custom-input" label="Correo electrónico:" label-for="i-email">
      <b-form-input id="i-email" type="email" v-model="$root.user.email" size="sm" required placeholder="Escriba correo electrónico" />
    </b-form-group>

    <b-form-group class="custom-input" label="Teléfono:" label-for="i-tel">
      <b-form-input id="i-tel" type="text" v-model="$root.user.phone" size="sm" required placeholder="Escriba su teléfono" maxlength="10"/>
    </b-form-group>

    <!-- <h6 class="mt-5">Dirección</h6>
    <hr class="c-hr" />

    <div class="row mx-0 no-gutters" v-if="$root.user.address">
      <div class="col-md-7 col-lg-6">
        <b-form-group class="custom-input" label="Calle:" label-for="i-calle">
          <b-form-input id="i-calle" type="text" v-model="$root.user.address.street" size="sm" required placeholder="Calle donde vive" />
        </b-form-group>
      </div>

      <div class="col-md pl-md-3">
        <b-form-group class="custom-input" label="Numero ext:" label-for="i-num">
          <b-form-input id="i-numext" type="text" v-model="$root.user.address.num_ext" size="sm" required placeholder="0000" />
        </b-form-group>
      </div>

      <div class="col-md pl-md-3">
        <b-form-group class="custom-input" label="Numero int:" label-for="i-num">
          <b-form-input id="i-numint" type="text" v-model="$root.user.address.num_int" size="sm" placeholder="0000" />
        </b-form-group>
      </div>
    </div>

    <div class="row mx-0 no-gutters" v-if="$root.user.address">
      <div class="col-md-8">
        <b-form-group class="custom-input" label="Colonia:" label-for="i-colonia">
          <b-form-input id="i-colonia" type="text" v-model="$root.user.address.neighborhood" size="sm" required placeholder="Escriba su colonia" />
        </b-form-group>
      </div>

      <div class="col-md pl-md-3">
        <b-form-group class="custom-input" label="Código postal:" label-for="i-cp">
          <b-form-input id="i-cp" type="text" v-model="$root.user.address.zipcode" size="sm" required placeholder="Escriba su código postal" />
        </b-form-group>
      </div>
    </div>


    <div class="row mx-0 no-gutters" v-if="$root.user.address">
      <div class="col-md-6 pr-md-3">
        <b-form-group class="custom-input" label="Estado:" label-for="i-estado">
          <v-select v-model="$root.user.address.state_id" :options="states" label="name" index="id" @change="getTowns"/>
        </b-form-group>
      </div>

      <div class="col-md-6">
        <b-form-group class="custom-input" label="Ciudad:" label-for="i-ciudad">
          <v-select v-model="$root.user.address.town_id" :options="towns" label="name" index="id"/>
        </b-form-group>
      </div>
    </div>
 -->
    <b-button type="submit" class="btn-red btn-form" variant="primary" :disabled="disabled">Guardar cambios</b-button>

  </b-form>

    <sweet-modal :icon="modal.icon" :blocking="modal.block" :hide-close-button="modal.block" ref="modal">
        <div class="fa-3x" v-if="modal.icon== ''"><i class="fas fa-spinner fa-pulse"></i></div><br/>
        {{modal.msg}}
        <div class="col-12 text-center" style="padding-top: 20px;" v-if="modal.icon == 'success'">
        <b-button class="btn btn-primary" slot="button" v-on:click.prevent="$refs.modal.close();">OK</b-button>
        </div>
    </sweet-modal>
</div>
</template>

<script>
export default {
  data(){
    return{
        states: [],
        towns: [],
        disabled: false,

        modal:{
          msg:'',
          icon:'',
          block:false,
        },
    }
  },

  watch:{
    '$root.user.customer.state_id':function(val){
      if(val && !isNaN(val)){
        //this.getTowns(val);
      }
    }
  },

  methods: {
    getStates(){
      axios.get(tools.url('/api/states')).then((response)=>{
        this.states = response.data;
      }).catch((error)=>{
         console.log(error);
      });
    },

    getTowns(state_id){
        if(state_id){
            axios.get(tools.url('/api/towns/' + state_id)).then((response)=>{
              this.towns = response.data;
            }).catch((error)=>{
              console.log(error);
            });
        }else{
            this.towns = [];
        }
    },

    onSubmit(){
        var data = {
            id: this.$root.user.id,
            name: this.$root.user.name,
            lastname: this.$root.user.lastname,
            email: this.$root.user.email,
            phone: this.$root.user.phone,
            //customer
            street: this.$root.user.address.street,
            num_int: this.$root.user.address.num_int,
            num_ext: this.$root.user.address.num_ext,
            neighborhood: this.$root.user.address.neighborhood,
            zipcode: this.$root.user.address.zipcode,
            state_id: this.$root.user.address.state_id,
            town_id: this.$root.user.address.town_id,
        };

        this.disabled = true;

        axios.post(tools.url('/api/user/profile'), data).then((response)=>{
            if(response.data.status == 'success'){
                this.disabled = false;
                this.modal.icon = "success";
                this.modal.msg = response.data.msg;
                this.modal.block = false;
                this.$refs.modal.open();
            }else{
                this.disabled = false;
                this.modal.icon = "error";
                this.modal.msg = response.data.msg;
                this.modal.block = false;
                this.$refs.modal.open();
            }
        }).catch((error)=>{
            this.disabled = false;
            this.handleErrors(error);
        });
    },

    handleErrors:function(errors){
        var err="";

        if (errors.response) {
            if(errors.response.data.errors){
                jQuery.each(errors.response.data.errors,(k,v)=>{
                    err+="*"+v[0]+"\n";
                });
            }
        }
        else{
            console.log(errors);
            err="Error desconocido.";
        }

        this.modal.icon = "error";
        this.modal.msg = err;
        this.modal.block = false;
        this.$refs.modal.open();

    },
  },

  beforeMount(){
    this.getStates();
  },

  mounted(){
    if(this.$root.user.address && this.$root.user.address.state_id){
      this.getTowns(this.$root.user.address.state_id);
    }
  }
}
</script>
