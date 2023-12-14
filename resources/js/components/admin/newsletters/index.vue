<template>
    <div>
      <ol class="breadcrumb 2">
              <li><router-link to="/home"><i class="entypo-home"></i>Home</router-link></li>
              <li class="active"><strong>Newsletters</strong></li>
          </ol>
          <h2 class="margin-bottom">Newsletters</h2>
  
          <div class="row">
              <div class="col-md-12">
                  <div id="toolbar">
        
                    <button class="btn btn-danger btn-sm" @click="deleteRows()"><i class="fa fa-trash"></i> Borrar</button>
                  </div>
                  <table id="datable"></table>
              </div>
          </div>
      </div>
  </template>
  <script type="text/javascript">
    export default {
    data(){
      return {
        news:[],
      }
    },
    methods:{
      mounthTable(){
        jQuery('#datable').bootstrapTable({
          columns: [
            {
              field:"check",
              checkbox:true,
              align: 'center',
            },
            {
              field: 'id',
              title: '#',
              sortable:false,
              switchable:true,
            },       
            {
              field: 'email',
              title: 'Email',
              sortable:true,
              switchable:true,
            },
            {
              field: 'created',
              title: 'Fecha y hora de registro',
              sortable:true,
              switchable:true,
            },
  
            
          ],
          showRefresh:true,
        });
  
        jQuery('#datable').on('refresh.bs.table',()=>{
          this.getRows();
        });
  
        jQuery('#datable').on('click-row.bs.table',(row,data)=>{
          //this.$router.push('/newsletters/edit/'+data.id);
        });
  
        this.getRows();
  
      },
      getRows(){
        this.$parent.inPetition=true;
        axios.get(tools.url("/api/admin/newsletters")).then((response)=>{
            this.news = response.data;
            jQuery('#datable').bootstrapTable('removeAll');
            jQuery('#datable').bootstrapTable('append',this.news);
            this.$parent.inPetition=false;
          }).catch((error)=>{
              this.$parent.handleErrors(error);
              this.$parent.inPetition=false;
          });
      },
  
      deleteRows:function(){
        var rows=jQuery('#datable').bootstrapTable('getSelections');
        if(rows.length==0){
          return false;
        }
        alertify.confirm("Alerta!","¿Seguro que deseas borrar "+rows.length+" registros?",()=>{
          this.$parent.inPetition=true;
          var params={};
          params.ids=jQuery.map(rows,(row)=>{
            return row.id;
          });
  
          axios.delete(tools.url('/api/admin/newsletters'),{data:params})
          .then((response)=>{
            this.$parent.showMessage(response.data.msg,"success");
            this.getRows();
            this.$parent.inPetition=false;
          })
          .catch((error)=>{
            this.$parent.handleErrors(error);
                this.$parent.inPetition=false;
          });
        },
        ()=>{
        });
      }
    },
        mounted() {
            this.mounthTable();
        }
    }
  </script>
  