import SideBar from './components/Template/SidebarPlugins'
import EventHub from './components/Template/EventHubPlugin'
const GlobalComponents = {
  install(Vue) {
    Vue.use(SideBar)
    Vue.use(EventHub)
  }
}

export default GlobalComponents