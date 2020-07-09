<template>
  <div class="left-sidebar">
    <weather />

    <v-card outlined>
      <v-subheader>Market Trends</v-subheader>
      <v-tabs color="basil" fixed-tabs>
        <v-tab class="text-capitalize">Market</v-tab>
        <v-tab class="text-capitalize">News</v-tab>

        <v-tab-item>
          <v-simple-table>
            <template v-slot:default>
              <thead>
                <tr>
                  <th class="text-left">Name</th>
                  <th class="text-left">Month</th>
                  <th class="text-left">Rates (rs)</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="trend in markets" :key="trend.id">
                  <td>{{trend.crop}}</td>
                  <td>{{trend.month}}</td>
                  <td>{{trend.rate}}</td>
                </tr>
              </tbody>
            </template>
          </v-simple-table>
        </v-tab-item>
        <v-tab-item>
          <v-list-item two-line>
            <v-list-item-content>
              <p class="short-news" v-for="article in news" :key="article.id">{{article.content}}</p>
            </v-list-item-content>
          </v-list-item>
        </v-tab-item>
      </v-tabs>
    </v-card>
  </div>
</template>

<script>
import weather from "./weather";

export default {
  components: {
    weather
  },
  data() {
    return {
      news: [],
      markets: []
    };
  },
  mounted() {
    this.loadMarket();
    this.loadNews();
  },
  methods: {
    loadMarket() {
      axios
        .get("/market")
        .then(res => {
          if (res.status == 200) {
            this.markets = res.data.data;
          }
        })
        .catch(err => {
          console.log(err);
        });
    },
    loadNews() {
      axios
        .get("/news")
        .then(res => {
          if (res.status == 200) {
            this.news = res.data.data;
          }
        })
        .catch(err => {
          console.log(err);
        });
    }
  }
};
</script>

<style lang="scss" scoped>
.short-news {
  font-size: 13px;
  line-height: 16px;
  color: #444;
  border-bottom: 1px solid #efefef;
  padding: 8px 0;
}
</style>