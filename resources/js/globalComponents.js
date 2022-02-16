import SideBar from './components/Template/SidebarPlugins'
import EventHub from './components/Template/EventHubPlugin'
import vSelect from 'vue-select'
const GlobalComponents = {
  install(Vue) {
    Vue.use(SideBar)
    Vue.use(EventHub)
    Vue.component('v-select', vSelect)
  }
}

export default GlobalComponents