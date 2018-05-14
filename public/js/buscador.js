// Search for places on Foursquare.

// The URL is taken from the form's 'action' attribute. This can also be set
// explicitly using the 'url' option, but since this form is solely for the
// search field, it makes sense to use the 'action' attribute.
$('#location').marcoPolo({
  // The max number of results is sent as extra data with the request. The
  // search value is automatically included as 'q', but can be changed through
  // the 'param' option as seen below.
  data: {
    limit: 20,
  },
  //recoge los datos
  formatData: function (data) {
    console.log("esto son los datos"+data);
    return data;
  },
  // muestra la lista
  formatItem: function (data, $item) {
    return "<img class='imgbuscador' src="+data.img+">"+data.nombre ;
  },
  //minimo de caracteres que hacen falta para que busque
  minChars: 1,

  //cuando se hace clic en un elemento lo autocompleta en el input
  onSelect: function (data, $item) {
    this.val(data.nombre);
    this.attr("slug", data.slug);
  },
  
  //parametro que se pasa a la api
  param: 'query',
});