export default function ({$axios, store}) {
  $axios.onError(error => {
    console.log(error)
  })

  $axios.onRequest(() => {
    console.log("teste on Request")
  })
}