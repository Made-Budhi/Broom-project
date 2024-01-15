$(function(){
    $("#form-total").steps({
        headerTag: "h2",
        bodyTag: "section",
        transitionEffect: "fade",
        // enableAllSteps: true,
        autoFocus: true,
        transitionEffectSpeed: 500,
        titleTemplate : '<div class="title">#title#</div>',
        labels: {
            previous : 'Kembali',
            next : '<i class="fa-solid fa-arrow-right"></i>',
            finish : '<button class="btn" type="button" data-bs-toggle="modal" data-bs-target="#exampleModal" ><i class="fa-solid fa-paper-plane"></i></button>',
            current : ''
        }
    });
});
