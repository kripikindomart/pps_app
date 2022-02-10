import SideBar from './components/Template/SidebarPlugins'

const GlobalComponents = {
  install(Vue) {
    Vue.use(SideBar)
  }
}

export default GlobalComponents