const tour = new Shepherd.Tour({
    defaultStepOptions: {
      cancelIcon: {
        enabled: true
      },
      classes: 'class-1 class-2',
      scrollTo: { behavior: 'smooth', block: 'center' }
    }
  });
  
  tour.addStep({
    title: 'تلميح',
    text: `من هنا يمكنك ادارة طلباتك ومشاهدة أحدث طلبات العروض`,
    attachTo: {
      element: '#hero-example',
      on: 'bottom'
    },
    buttons: [
      {
        action() {
          return this.back();
        },
        classes: 'shepherd-button-secondary',
        text: 'Back'
      },
      {
        action() {
          return this.next();
        },
        text: 'Next'
      }
    ],
    id: 'creating'
  },
  );
  tour.addStep({
    title: 'تلميح', 
    text: `Creating a Shepherd tour is easy. too 22!\
    Just create a \`Tour\` instance, and add as many steps as you want.`,
    attachTo: {
      element: '#hero-example',
      on: 'bottom'
    },
    buttons: [
      {
        action() {
          return this.back();
        },
        classes: 'shepherd-button-secondary',
        text: 'Back'
      },
      {
        action() {
          return this.next();
        },
        text: 'Next'
      }
    ],
    id: 'creating'
  },
  );
  
 // tour.start();