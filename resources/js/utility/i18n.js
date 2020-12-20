import Vue from 'vue'
import VueI18n from 'vue-i18n'

Vue.use(VueI18n);

const messages = {
	'en': {
		selectCity: 'Select City',
		language: 'Language',
		venue: 'Venue',
		landmark: 'Landmark',
		address: 'Address',
		category: 'Category',
		coordinates: 'Coordinates',
		latitude: 'latitude',
		longitude: 'longitude',
		today: 'Today',
		min: 'min',
		max: 'max',
		wind: 'Wind',
		humidity: 'Humidity',
		visibility: 'Visibility',
		cities: [
			{ city:'Tokyo', name:'Tokyo', state:'JP' },
			{ city:'Yokohama', name:'Yokohama', state:'JP' },
			{ city:'Kyoto', name:'Kyoto', state:'JP' },
			{ city:'Osaka', name:'Osaka', state:'JP' },
			{ city:'Sapporo', name:'Sapporo', state:'JP' },
			{ city:'Nagoya', name:'Nagoya', state:'JP' }
		]
	},

	'ja': {
		selectCity: '都市を選択',
		language: '言語',
		venue: '会場',
		landmark: 'ランドマーク',
		address: '住所',
		category: 'カテゴリ',
		coordinates: '座標',
		latitude: '緯度',
		longitude: '経度',
		today: '今日',
		min: '最小',
		max: '最大',
		wind: '風',
		humidity: '湿度',
		visibility: '可視性',
		cities: [
			{ city:'Tokyo', name:'Tokyo 東京', state:'JP' },
			{ city:'Yokohama', name:'Yokohama 横浜', state:'JP' },
			{ city:'Kyoto', name:'Kyoto 京都', state:'JP' },
			{ city:'Osaka', name:'Osaka 大阪', state:'JP' },
			{ city:'Sapporo', name:'Sapporo 札幌', state:'JP' },
			{ city:'Nagoya', name:'Nagoya 名古屋}', state:'JP' }
		]
	}
}

const i18n = new VueI18n({
	locale: 'en',   
	fallbackLocale: 'ja',  
	messages,
});

export default i18n