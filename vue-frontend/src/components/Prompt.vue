<template>
  <div id="Prompt">
    <div id="overlay"></div>
    <div class="promptContainer">
      <v-card class="innerBox">
        <span id="x">X</span>
        <h2>{{title}}</h2>
        <img :src="img" alt="">
        <p>{{msg}}</p>
        <p>{{price}} &#163;</p>
        <div class="d-flex flex-wrap justify-center" style="width:80%; margin: 0 auto;">
          <v-btn 
          v-for="(extra, index) in this.itemExtras" :key="index" 
          class="mr-2 ml-2 mb-4"
          width="180px"
          style="
          margin:0;
          padding:0;
          "
          >
            <div class="checkbox-container">
              <input type="checkbox" :id="extra" :name="extra" v-model="selectedExtras[extra]">

              <label :for="extra" class="mr-2">
                {{extra}}
              </label>

            </div>
          </v-btn>
        </div>

        <v-btn 
          class="red white--text mb-5 mt-5"
          @click="addingToCart"
        >Add to cart
        </v-btn>

      </v-card>
    </div>
  </div>
</template>
<script>
export default {
  name:'Prompt',
  props: {
    msg: String,
    displayPrompt: String,
    title:String,
    img: String,
    price:String,
    extras:String
  },
  watch: {
    displayPrompt: function(){
      this.promptDisplay()
    },
    extras: function(){
      this.createSelectedExtras(); //this must go first.
      this.extraCheckboxMaker();
    }
  },
  data(){
    return {
      itemExtras:[],
      selectedExtras:[]
    }
  },
  methods:{
    promptDisplay(){ //this should not be here. No document select, use a v-if
      if(this.displayPrompt == 'false'){
        document.getElementById('prompt').style.display='none'
      } else if(this.displayPrompt == 'true')
        document.getElementById('prompt').style.display='block'
    },

    extraCheckboxMaker(){ 
    this.itemExtras = []; //imam neki bug ovde - ovo je resenje. Clearing out the itemExtras before leaving
      if(this.extras && this.extras.indexOf(',') != -1){ //if there is no , it means there is one extra which will be added
        this.itemExtras = this.extras.split(', ');
      } else {
        this.itemExtras.push(this.extras)
        console.log(this.itemExtras)
      }
    },

    createSelectedExtras(){
      for(var i = 0; i < this.itemExtras.length; i++){
        this.selectedExtras[this.itemExtras[i]] = false;
      }
    },

    addingToCart(){
      var keys = Object.keys(this.selectedExtras); //change name of this to extraValue
      var chosenExtras = [];

      for(var i = 0; i < keys.length; i++){
        if(this.selectedExtras[keys[i]] === true){
          chosenExtras.push(keys[i])
        }
      }

      // this.clearSelectedExtras() //maybe this ???
      this.$emit("adding-to-cart",chosenExtras) //ne saljem nikakav podatak tako da mi ne treba ovo
      this.selectedExtras = [];
      // this.itemExtras = []; //just a precaution but not necessary
    }
  },
  mounted(){
    this.promptDisplay()
    console.log(this.selectedExtras)
    document.getElementById('x').addEventListener('click',()=>{ //ne trebas ovako.
      this.$emit("update-prompt") //ne manjati vrednost propa unutar komponente. Ne saljem nikakve podatke, jer order ih sve vec ima
      this.selectedExtras = [];
    })


    //enter click
    document.addEventListener("keydown",(e)=>{
      if((e.keyCode == '13' || e.which == '13') && this.displayPrompt == 'true'){ //samo ce na enter proizvod da radi ako vidi da je otvorena kutija
        this.addingToCart()
        this.$emit("update-prompt");
      }
    })

    //escape
    document.addEventListener("keydown",(e)=>{
      if(e.keyCode == 27 || e.which == 27){
         this.$emit("update-prompt") //ako klikne esc, onda mu zatvara ovaj prozor
         this.selectedExtras = [];
      }
    })
  }
}
</script>
<style lang="scss" scoped>
#overlay{
  background-color: rgba(102, 101, 101, 0.6);
  width:100%;
  height:100%;
  position: fixed;
  z-index: 9;
  top:0;
  left:0;
}
.promptContainer {
  width:100%;
  height:100%;
  position: fixed;
  left:0;
  top:0;
  z-index: 10;

}
.innerBox {
  // width:600px;
  width:53%;
  margin:20px auto 0 auto;
  padding:30px;
  max-height:90%;
  overflow-y: scroll;
  img {
    width:65%;
    margin: 0 auto;
  }
  .checkbox-container {
    position:relative;
    input {
      position:absolute;
      left: 20px;
      top:10px;
      // display: none;

    }
    label {
      display:inline-block;
      padding:10px 40px;
      width:180px;
      margin-left: 7px; 
      // border:1px solid red;
    }
  }
}

#x {
  // float:right;
  padding:2px 10px;
  border-radius:50%;
  background-color: red;
  color:#fff;
  position:absolute;
  right:25px;
}

#x:hover {
  background-color:rgb(248, 47, 47);
  cursor: pointer;
}

@media (max-width: 791px){
  .innerBox {
    width:60%;
  }
}

@media (max-width: 575px){
  .innerBox {
    width:80%;
  }
}
</style>