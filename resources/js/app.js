import './bootstrap';
import { createApp } from "vue";
import TrackBlockItem from "./components/Admin/TrackBlockItem.vue";
import TrackItem from "./components/Admin/TrackItem.vue";

const app = createApp({})
app.component('track-item', TrackItem)
app.component('track-block-item', TrackBlockItem)
app.mount('#api')
