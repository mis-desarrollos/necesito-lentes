<template>
    <div>
      <ol class="breadcrumb 2">
              <li><router-link to="/home"><i class="entypo-home"></i>Home</router-link></li>
              <li class="active"><strong>Examanes de la vista</strong></li>
          </ol>
          <h2 class="margin-bottom">Examanes de la vista</h2>
  
          <div class="row">
              <div class="col-md-12">
                  
                  <button class="btn btn-success btn-sm" @click="addnewrow"><i class="fa fa-plus"></i> Nuevo</button>
                 <!--  <button class="btn btn-danger btn-sm" @click="deleteRow()"><i class="fa fa-trash"></i> Borrar</button> -->
  
                  <FullCalendar :options="calendarOptions" />
  
              </div>
          </div>
          <sweet-modal ref="addOrderModal">
              <form role="form" class="form-horizontal" @submit.prevent="newRow($event.target)">
  
                  
  
                  <input-form name="customer_name" text="Cliente" :data.sync="orderForm.name" ></input-form>
                  <input-form name="customer_phone" text="Telefono" :data.sync="orderForm.phone" ></input-form>
                  <input-form name="customer_email" text="Email" :data.sync="orderForm.email" ></input-form>
  
                  <input-form type="date" name="day_reservation" text="Fecha" :data.sync="orderForm.date" ></input-form>
  
                  <input-form type="time" name="time_start" text="Hora" :data.sync="orderForm.hour" ></input-form>
  
                 

                  <div class="form-group">
                      <label class="col-sm-3 control-label">Optica:</label>
                      <div class="col-sm-7">
                          <v-select v-model="orderForm.opticians_id" :options="opticiansOpcs" label="name" index="id" />
                      </div>
                  </div>    

                  <text-form  name="comments" text="Comentarios" :data.sync="orderForm.comments" ></text-form>
       
  
                  <div class="form-group">
                      <div class="col-sm-12">
                          <button type="button" class="btn btn-danger pull-left" @click="deleteOrder()"><i class="fa fa-trash"></i> Borrar</button>
                          <button type="submit" class="btn btn-success pull-right"><i class="far fa-save"></i> Guardar</button> 
                          <button type="button" class="btn btn-default pull-right" @click="$refs.addOrderModal.close()">Cancelar</button>			
                      </div>
                  </div>
              </form>	
          </sweet-modal>
      </div>
  </template>
  <script type="text/javascript">
  import FullCalendar from '@fullcalendar/vue'
  import dayGridPlugin from '@fullcalendar/daygrid'
  import interactionPlugin from '@fullcalendar/interaction'
  import esLocale from '@fullcalendar/core/locales/es';
  
        export default {
        components: {
              FullCalendar,
        },
       data(){
          return {
              orderForm:{

              },
                calendarOptions: {
  
  
                    headerToolbar: {
                
                    right: 'dayGridMonth,dayGridWeek,dayGridDay'
                  },
                    editable: true,
                  selectable: true,
                  selectMirror: true,
                  eventClick: this.handleEventClick,
  
                  plugins: [ dayGridPlugin, interactionPlugin ],
                  initialView: 'dayGridMonth',
  
                  events: [
                   
                  ],
                  locale:esLocale,
                  
                },
                fieldsOpcs:[],
                statusOpcs:[
                    {id:'Agendada'},
                    {id:'Cancelada'}
                ],
                opticiansOpcs:[]
            
          }
      },
      watch:{
          
  
      },
      methods:{
         
          getRows(){
            this.$parent.inPetition=true;
            axios.get(tools.url("/api/admin/exams")).then((response)=>{
                this.calendarOptions.events = response.data;
                
                this.$parent.inPetition=false;
              }).catch((error)=>{
                  this.$parent.handleErrors(error);
                  this.$parent.inPetition=false;
              });
          },
  
          deleteRow:function(){
            var rows=jQuery('#news').bootstrapTable('getSelections');
            if(rows.length==0){
              return false;
            }
            alertify.confirm("Alerta!","¿Seguro que deseas borrar "+rows.length+" registros?",()=>{
              this.$parent.inPetition=true;
              var params={};
              params.ids=jQuery.map(rows,(row)=>{
                return row.id;
              });
  
              axios.delete(tools.url('/api/admin/blogs'),{data:params})
              .then((response)=>{
                this.$parent.showMessage(response.data.msg,"success");
                this.getNews();
                this.$parent.inPetition=false;
              })
              .catch((error)=>{
                this.$parent.handleErrors(error);
                    this.$parent.inPetition=false;
              });
            },
            ()=>{
            });
          },
          showEvent: function(arg) {
              console.log(arg);
            alert('date click! ' + arg.dateStr)
          },
  

  
          addnewrow(){
              this.orderForm = {
                  id:null,
                  name:null,
                  phone:null,
                  email:null,
  
                  date:null,
                  hour:null,
                  comments:null,
                  opticians_id:null,
              };
              this.$refs.addOrderModal.open();
          },
          newRow(form){				
              this.$parent.inPetition=true;
              this.$parent.validateAll(()=>{
  
  
                  if(this.orderForm.id){
                          axios.post(tools.url("/api/admin/exams/"+this.orderForm.id),this.orderForm)
                          .then((response)=>{
                              this.orderForm = {
                                id:null,
                                name:null,
                                phone:null,
                                email:null,
                
                                date:null,
                                hour:null,
                                comments:null,
                                opticians_id:null,
                              };
                              this.$refs.addOrderModal.close();
                              this.$parent.showMessage("Registro modificado correctamente!","success");
                              this.$parent.inPetition=false;
                              this.getRows();
                          }).catch((error)=>{
                              this.$parent.handleErrors(error);
                              this.$parent.inPetition=false;
                          });
                  }
                  else{
                          axios.post(tools.url("/api/admin/exams"),this.orderForm)
                          .then((response)=>{
                              this.orderForm = {
                                id:null,
                                name:null,
                                phone:null,
                                email:null,
                
                                date:null,
                                hour:null,
                                comments:null,
                                opticians_id:null,    
                              };
                              this.$refs.addOrderModal.close();
  
                              var news = response.data;
                              this.$parent.showMessage("Registro agregado correctamente!","success");
                              
                              this.$parent.inPetition=false;
                              this.getRows();
                          }).catch((error)=>{
                              this.$parent.handleErrors(error);
                              this.$parent.inPetition=false;
                          });
                  }
              },(e)=>{
                  console.log(e);
                  this.$parent.inPetition=false;
              });				
          },
          handleEventClick(clickInfo){
              var indx = null;
              for (var i = 0; i < this.calendarOptions.events.length; i++) {
                  if(this.calendarOptions.events[i].id == clickInfo.event.id){
                      indx = i;
                      break;
                  }
              }
                
                this.orderForm = this.calendarOptions.events[indx];
                this.$refs.addOrderModal.open();
          },
          deleteOrder(){
              this.$refs.addOrderModal.close();
              alertify.confirm("Alerta!","¿Seguro que desea eliminar este registro?",() => {
                  axios.delete(tools.url("/api/admin/exams/" + this.orderForm.id )).then(result => {
                      this.getRows();
                      this.$parent.showMessage(result.data.msg, "success");
                  }).catch(error => {
                      
                  });
              }, ()=>{});
          },
          getOpticiansOpcs(){
            axios.get(tools.url("/api/admin/opticians")).then((response)=>{
                this.opticiansOpcs = response.data;
            }).catch((error)=>{
            });
        },
  
  
      },
      mounted() {
            this.getOpticiansOpcs();
            this.getRows(); 
      }
    }
  </script>
  <style type="text/css">
  
  </style>
  