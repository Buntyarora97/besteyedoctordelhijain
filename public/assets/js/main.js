// besteyedoctordelhi.com - progressive enhancement only
(function(){
  var mt=document.getElementById('menuToggle'),nav=document.getElementById('mainNav');
  if(mt&&nav) mt.addEventListener('click',function(){
    var open=nav.classList.toggle('open');
    mt.setAttribute('aria-expanded',open?'true':'false');
    mt.setAttribute('aria-label',open?'Close menu':'Open menu');
  });

  var sb=document.getElementById('searchBtn'),ov=document.getElementById('searchOverlay'),
      inp=document.getElementById('globalSearch'),res=document.getElementById('searchResults'),
      closeBtn=document.getElementById('searchClose');
  if(sb&&ov){sb.addEventListener('click',function(){ov.hidden=false;inp.focus()});
    if(closeBtn) closeBtn.addEventListener('click',function(){ov.hidden=true});
    ov.addEventListener('click',function(e){if(e.target===ov)ov.hidden=true});}
  var t;
  if(inp) inp.addEventListener('input',function(){
    clearTimeout(t);
    if(inp.value.length<2){res.replaceChildren();return}
    t=setTimeout(function(){
      fetch('/api/search?q='+encodeURIComponent(inp.value))
        .then(function(r){if(!r.ok)throw new Error('Search request failed');return r.json()})
        .then(function(d){
          res.replaceChildren();
          var results=Array.isArray(d.results)?d.results:[];
          results.forEach(function(x){
            var url;
            try{url=new URL(String(x.url||''),window.location.origin)}catch(e){return}
            if(url.origin!==window.location.origin)return;
            var a=document.createElement('a');
            a.href=url.pathname+url.search+url.hash;
            var type=document.createElement('strong');
            type.textContent='['+String(x.type||'')+']';
            a.append(type,document.createTextNode(' '+String(x.title||'')));
            res.appendChild(a);
          });
          if(!res.childElementCount){
            var empty=document.createElement('p');
            empty.className='muted';
            empty.style.padding='10px';
            empty.textContent='No results.';
            res.appendChild(empty);
          }
        }).catch(function(){
          res.replaceChildren();
          var error=document.createElement('p');
          error.className='error';
          error.setAttribute('role','status');
          error.textContent='Search is temporarily unavailable. Please try again.';
          res.appendChild(error);
        });
    },250);
  });

  var ff=document.getElementById('finderForm');
  if(ff) ff.addEventListener('submit',function(e){
    e.preventDefault();
    var out=document.getElementById('finderResult');
    out.textContent='Thinking...';
    fetch('/api/finder',{method:'POST',body:new FormData(ff)})
      .then(function(r){if(!r.ok)throw new Error('Finder request failed');return r.json()}).then(function(d){
        out.replaceChildren();
        var result=document.createElement('div');
        result.className=d.urgent?'error':'success';
        result.setAttribute('role',d.urgent?'alert':'status');
        var message=document.createElement('p');
        message.textContent=d.message||'Please contact the hospital for guidance.';
        result.appendChild(message);
        if(d.urgent&&d.phone){
          var phone=document.createElement('a');
          phone.href='tel:'+String(d.phone).replace(/[^0-9+]/g,'');
          phone.textContent='Call '+String(d.phone);
          result.appendChild(phone);
        }else{
          (Array.isArray(d.doctors)?d.doctors:[]).forEach(function(x){
            var row=document.createElement('p'),doctor=document.createElement('a');
            doctor.href='/doctors/'+encodeURIComponent(String(x.slug||''));
            doctor.textContent=String(x.name||'Eye specialist');
            row.append(doctor,document.createTextNode(' — '+String(x.designation||'')));
            result.appendChild(row);
          });
          var action=document.createElement('p'),book=document.createElement('a');
          book.className='btn btn-primary';
          var bookingUrl;
          try{bookingUrl=new URL(String(d.bookUrl||'/book-appointment'),window.location.origin)}catch(e){bookingUrl=null}
          book.href=bookingUrl&&bookingUrl.origin===window.location.origin?bookingUrl.pathname+bookingUrl.search:'/book-appointment';
          book.textContent='Book';
          action.appendChild(book);
          result.appendChild(action);
        }
        out.appendChild(result);
      }).catch(function(){
        out.replaceChildren();
        var error=document.createElement('p');
        error.className='error';
        error.setAttribute('role','alert');
        error.textContent='Something went wrong. Please call the hospital.';
        out.appendChild(error);
      });
  });

  // Hero orbit: max 4-6px parallax on cursor (desktop, motion-safe only)
  var visual=document.getElementById('compassOrbit');
  if(visual && !window.matchMedia('(prefers-reduced-motion: reduce)').matches && window.matchMedia('(pointer: fine)').matches){
    document.addEventListener('mousemove',function(e){
      var x=(e.clientX/window.innerWidth-0.5)*8, y=(e.clientY/window.innerHeight-0.5)*8;
      visual.style.transform='translate('+x+'px,'+y+'px)';
    });
  }

  // Enquiry dialog: keyboard friendly, no dependency on a UI library.
  var enquiryOpen=document.getElementById('enquiryOpen'), mobileEnquiryOpen=document.getElementById('mobileEnquiryOpen'),
      dialog=document.getElementById('enquiryDialog'),
      enquiryClose=document.getElementById('enquiryClose'), lastFocus=null;
  function closeDialog(){
    if(!dialog) return;
    dialog.hidden=true;
    document.body.classList.remove('dialog-open');
    if(lastFocus) lastFocus.focus();
  }
  if(dialog){
    [enquiryOpen,mobileEnquiryOpen].filter(Boolean).forEach(function(trigger){
      trigger.addEventListener('click',function(){
      lastFocus=document.activeElement;
      dialog.hidden=false;
      document.body.classList.add('dialog-open');
      if(enquiryClose) enquiryClose.focus();
      });
    });
    if(enquiryClose) enquiryClose.addEventListener('click',closeDialog);
    dialog.addEventListener('click',function(e){
      if(e.target.hasAttribute('data-dialog-close')) closeDialog();
    });
    dialog.addEventListener('keydown',function(e){
      if(e.key==='Escape'){closeDialog();return}
      if(e.key!=='Tab')return;
      var focusable=dialog.querySelectorAll('a[href],button:not([disabled]),input:not([disabled]),select:not([disabled]),textarea:not([disabled])');
      if(!focusable.length)return;
      var first=focusable[0],last=focusable[focusable.length-1];
      if(e.shiftKey&&document.activeElement===first){e.preventDefault();last.focus()}
      else if(!e.shiftKey&&document.activeElement===last){e.preventDefault();first.focus()}
    });
  }

  // Tap support for the eye map: the description is hidden until selected.
  document.querySelectorAll('.eye-region').forEach(function(btn){
    btn.addEventListener('click',function(){
      document.querySelectorAll('.eye-region').forEach(function(other){if(other!==btn) other.classList.remove('active')});
      btn.classList.toggle('active');
    });
  });

  // Accessible gallery filtering and native-dialog lightbox.
  var galleryGrid=document.querySelector('[data-gallery-grid]');
  if(galleryGrid){
    var galleryCards=Array.prototype.slice.call(galleryGrid.querySelectorAll('[data-gallery-open]'));
    var galleryFilters=document.querySelectorAll('[data-gallery-filter]');
    var galleryDialog=document.getElementById('galleryLightbox');
    var galleryDialogImage=document.getElementById('galleryLightboxImage');
    var galleryDialogCaption=document.getElementById('galleryLightboxCaption');
    var galleryStatus=document.getElementById('galleryStatus');
    var visibleCards=galleryCards.slice(), activeGalleryIndex=0;
    function setGalleryFilter(filter){
      visibleCards=[];
      galleryCards.forEach(function(card){
        var visible=filter==='all'||card.getAttribute('data-gallery-category')===filter;
        card.hidden=!visible;
        if(visible) visibleCards.push(card);
      });
      if(galleryStatus) galleryStatus.textContent=visibleCards.length+' photos shown.';
    }
    galleryFilters.forEach(function(button){
      button.addEventListener('click',function(){
        var selected=button.getAttribute('data-gallery-filter')||'all';
        galleryFilters.forEach(function(other){
          var active=other===button;
          other.setAttribute('aria-pressed',active?'true':'false');
        });
        setGalleryFilter(selected);
      });
    });
    function showGalleryImage(index){
      if(!galleryDialog||!galleryDialogImage||!visibleCards.length)return;
      activeGalleryIndex=(index+visibleCards.length)%visibleCards.length;
      var card=visibleCards[activeGalleryIndex];
      var image=card.querySelector('img');
      galleryDialogImage.src=card.href;
      galleryDialogImage.alt=image?image.alt:'';
      if(galleryDialogCaption) galleryDialogCaption.textContent=card.getAttribute('data-gallery-title')||'Hospital gallery photo';
    }
    galleryCards.forEach(function(card){
      card.addEventListener('click',function(event){
        if(!galleryDialog||typeof galleryDialog.showModal!=='function')return;
        event.preventDefault();
        showGalleryImage(visibleCards.indexOf(card));
        galleryDialog.showModal();
      });
    });
    if(galleryDialog){
      var closeGallery=galleryDialog.querySelector('[data-gallery-close]');
      var previousGallery=galleryDialog.querySelector('[data-gallery-previous]');
      var nextGallery=galleryDialog.querySelector('[data-gallery-next]');
      if(closeGallery) closeGallery.addEventListener('click',function(){galleryDialog.close()});
      if(previousGallery) previousGallery.addEventListener('click',function(){showGalleryImage(activeGalleryIndex-1)});
      if(nextGallery) nextGallery.addEventListener('click',function(){showGalleryImage(activeGalleryIndex+1)});
      galleryDialog.addEventListener('click',function(event){if(event.target===galleryDialog)galleryDialog.close()});
      galleryDialog.addEventListener('keydown',function(event){
        if(event.key==='ArrowLeft'){event.preventDefault();showGalleryImage(activeGalleryIndex-1)}
        if(event.key==='ArrowRight'){event.preventDefault();showGalleryImage(activeGalleryIndex+1)}
      });
    }
    setGalleryFilter('all');
  }
})();
