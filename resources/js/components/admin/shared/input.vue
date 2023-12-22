<template>
	<div :class="{'form-group': true, 'has-error': errors.has(name) && fields[name].touched}">
	  <label for="field-1" class="col-sm-3 control-label">
		{{ text }}<span v-show="required">*</span>:
	  </label>
	  
	  <div class="col-sm-7">
		<input
		  v-if="type !== 'color'"
		  :type="type"
		  class="form-control"
		  v-validate="validate"
		  :name="name"
		  :placeholder="place"
		  :value="data"
		  @input="$emit('update:data', $event.target.value)"
		  :disabled="disabled"
		>
		<input
		  v-else
		  type="color"
		  class="form-control"
		  v-validate="validate"
		  :name="name"
		  :value="data"
		  @input="$emit('update:data', $event.target.value)"
		  :disabled="disabled"
		>
		<small class="has-error" v-show="errors.has(name) && fields[name].touched">
		  {{ errors.first(name) }}
		</small>
	  </div>
	</div>
  </template>
  
  <script>
  export default {
	props: {
	  name: { default: "" },
	  text: { required: true },
	  data: { default: "" },
	  validate: { default: "" },
	  place: { default: "" },
	  required: { default: false },
	  type: { default: "text" },
	  disabled: { default: false },
	},
	computed: {},
	mounted() {
	  if (this.name === "") {
		this.name = this.text.toLowerCase();
	  }
	},
  };
  </script>
  