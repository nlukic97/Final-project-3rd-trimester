  <template>
  <div id="Prompt">
    <div id="overlay"></div>
    <div class="promptContainer">
      <div class="innerBox">
        <span id="x">X</span>
        <h2>{{size}} {{title}}</h2>
        <img :src="img" alt="">
        <p>{{msg}}</p>
        <p>{{price}} £</p>

        <v-btn 
          class="red white--text"
          @click="addingToCart"
        >Add to cart
        </v-btn>

      </div>
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
    size:String,
    img: String,
    price:String,
    extras:Array
  },
  watch: {
    displayPrompt: function(){
      this.promptDisplay()
      // console.log(this.displayPrompt)
    }
  },
  data(){
    return {
      
    }
  },
  methods:{
    promptDisplay(){
      if(this.displayPrompt == 'false'){
        document.getElementById('prompt').style.display='none'
      } else if(this.displayPrompt == 'true')
        document.getElementById('prompt').style.display='block'
    },

    addingToCart(){
      this.$emit("adding-to-cart") //ne saljem nikakav podatak tako da mi ne treba ovo
    }
  },
  mounted(){
    this.promptDisplay()

    document.getElementById('x').addEventListener('click',()=>{
      this.$emit("update-prompt") //ne manjati vrednost propa unutar komponente. Ne saljem nikakve podatke, jer order ih sve vec ima
    })

    document.addEventListener("keydown",(e)=>{
      if((e.keyCode == '13' || e.which == '13') && this.displayPrompt == 'true'){ //samo ce na enter proizvod da radi ako vidi da je otvorena kutija
        this.addingToCart()
        this.$emit("update-prompt");
      }
    })

    document.addEventListener("keydown",(e)=>{
      if(e.keyCode == 27 || e.which == 27){
         this.$emit("update-prompt","false") //ako klikne esc, onda mu zatvara ovaj prozor
      }
    })
  }
}
</script>
<style lang="scss" scoped>
// #prompt {
//   display: none;
// }

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
  width:40%;
  margin:40px auto 0 auto;
  padding:20px;
  background-color:white;
  border:1px solid #333;
  img {
    width:80%;
    margin: 0 auto;
  }
}

#x {
  float:right;
  padding:3px 8px;
  background-color: red;
  color:#fff;
}

#x:hover {
  background-color:rgb(248, 47, 47);
  cursor: pointer;
}
</style>