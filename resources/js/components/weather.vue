<template>
  <v-card class="mx-auto mb-4 weather-card">
    <v-card-text>
      <div class="subheading font-weight-bold white--text mb-3">Get Weather Forcast</div>
      <input
        type="text"
        placeholder="Enter city name..."
        v-model="city"
        @keypress="fetchWeather"
        class="search-input"
      />
    </v-card-text>

    <v-card-text>
      <v-row align="center" v-if="typeof weather.main != 'undefined'" class="px-4">
        <div class="headline">{{weather.name}}, {{weather.sys.country}}</div>
        <div class="subheading">{{dateBuilder()}}, {{weather.weather[0].description}}</div>
        <div class="display-3 my-6">{{Math.round(weather.main.temp)}}&deg;C</div>
        <div>
          <ul>
            <li>- Humidity : {{weather.main.humidity}} %</li>
            <li>- Wind Speed : {{weather.wind.speed}}</li>
          </ul>
        </div>
      </v-row>
    </v-card-text>
  </v-card>
</template>

<script>
export default {
  name: "weather",
  data() {
    return {
      city: "",
      api_key: "4f4090cf0b13f2e354fc59e64bcb6f75",
      url_base: "https://api.openweathermap.org/data/2.5/",
      weather: {}
    };
  },
  methods: {
    fetchWeather(e) {
      if (e.key == "Enter") {
        fetch(
          `${this.url_base}weather?q=${this.city}&appid=${this.api_key}&units=metric&lang=hi`
        )
          .then(res => {
            return res.json();
          })
          .then(console.log(this.weather))
          .then(this.setResult);
      }
    },
    setResult(results) {
      this.weather = results;
    },
    dateBuilder() {
      let d = new Date();
      let months = [
        "January",
        "February",
        "March",
        "April",
        "May",
        "June",
        "July",
        "August",
        "September",
        "October",
        "November",
        "December"
      ];
      let days = [
        "Sunday",
        "Monday",
        "Tuesday",
        "Wednesday",
        "Thursday",
        "Friday",
        "Saturday"
      ];
      let day = days[d.getDay()];
      let date = d.getDate();
      let month = months[d.getMonth()];
      let year = d.getFullYear();

      return `${day} ${date} ${month} ${year}`;
    }
  }
};
</script>

<style lang="scss" scoped>
.weather-card {
  background-color: #e4fafa;
  background-image: url(/images/weather.png);
  background-size: cover;
  transition: 0.4s;
}
.search-input {
  border: 1px solid #dcdcdc;
  background: rgba($color: #ffffff, $alpha: 0.6);
  border-radius: 8px;
  padding: 8px 12px;
  color: #555;
  width: 100%;
  outline: none;
  &::placeholder {
    color: #555;
  }
}
ul {
  background: rgba(255, 255, 255, 0.8);
  border-radius: 4px;
  width: 100%;
  padding: 0.5em 2em;
  li {
    line-height: 2em;
    list-style: none;
    font-size: 1rem;
    width: 100%;
    font-weight: bold;
  }
}
</style>