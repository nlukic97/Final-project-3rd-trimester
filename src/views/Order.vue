<template>
<div class="order">
  <v-container>
  <h1>This is an order page</h1>
    <v-row>
      <v-col cols="12">
          <ul v-for="(item, index) in items" :key="index">
            <h4>{{item.size}} {{item.title}}</h4>
            <li>{{item.price}} £</li>
            <li>Extras:
              <ol>
                <li v-for="(extra, index) in item.extras" :key="index">
                  <span>{{extra}}</span>
                </li>
              </ol>
            </li>

          </ul>
      </v-col>
    </v-row>
  </v-container>
</div>
</template>
<script>
export default {
  name: 'Order',
  data(){
    return {
      items: [
        {
          title: 'Cod',
          size: 'Regular',
          price: 4.30,
          extras: [
            'salt',
            'vinager'
          ]
        },
        {
          title: 'Cod',
          size: 'Large',
          price: 5.30,
          extras: [
            'salt',
            'vinager'
          ]
        }
      ]
    }
  }
}
</script>
