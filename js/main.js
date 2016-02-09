
function Proches() {
  this.init();
}

Proches.prototype.init = function() {

  this.$ = {};

  this.$.container     = $('.wrapper-content')
  this.$.editBtn       = this.$.container.find('.btn-edit');
  this.$.deleteBtn     = this.$.container.find('.btn-delete');
  this.$.addBtn        = this.$.container.find('.btn-add')
  this.$.formContainer = this.$.container.find('.form-proches');
  this.$.form          = this.$.formContainer.find('form');

  console.log(this.$.form);

  this.initEvents();
}

Proches.prototype.initEvents = function() {

  var that = this;

  this.$.editBtn.on('click', function() {

    var number       = $(this).prev().children('.number').text(),
        numberSliced = number.slice(2, -1),
        name         = $(this).prev().children('strong').text();

    that.$.form.attr('data-number', numberSliced);
    that.$.form.attr('data-name', name);

    that.$.form.fadeIn();

  });

  this.$.deleteBtn.on('click', function() {


    that.$.formContainer.empty();
    $(this).parent().remove();

  });

  this.$.addBtn.on('click', function() {

    that.$.form.fadeIn();

  })

}


var proches = new Proches();