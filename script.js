console.log("BookCycle Loaded");
// ── DATA ──
const BOOKS = [
  {id:1,title:"Computer Networks: A Top-Down Approach",author:"Kurose & Ross",price:280,condition:"Good",subject:"IT & Computer Science",uni:"University of Pretoria",course:"COS3701",isbn:"9780136681557",emoji:"💻",color:"#2a6b4f",seller:"Thabo M.",sellerRating:4.8,sellerAvg:"TM",sellerColor:"#c94f1e",badge:"Hot Deal",desc:"8th edition. Some highlighting in chapters 3–4 but otherwise clean. All pages intact. Very relevant for Computer Networks module."},
  {id:2,title:"Business Management: A Contemporary Approach",author:"Nieuwenhuizen et al.",price:195,condition:"Fair",subject:"Business & Commerce",uni:"Tshwane University of Technology",course:"BUS101",isbn:"9780702190490",emoji:"📊",color:"#1a56a0",seller:"Ayanda S.",sellerRating:4.5,sellerAvg:"AS",sellerColor:"#8b5cf6",badge:"",desc:"Third edition. Pencil notes in margins. Cover has slight scuff. Content is completely readable and useful."},
  {id:3,title:"C++ Programming: From Problem Analysis to Program Design",author:"D.S. Malik",price:320,condition:"New",subject:"IT & Computer Science",uni:"University of Pretoria",course:"COS1512",isbn:"9781337102537",emoji:"⌨️",color:"#7c3aed",seller:"Sipho K.",sellerRating:5.0,sellerAvg:"SK",sellerColor:"#059669",badge:"Like New",desc:"Never used beyond one week. Switched modules. Still has the binding sticker. Includes CD-ROM."},
  {id:4,title:"Principles of Economics",author:"Mankiw",price:245,condition:"Good",subject:"Business & Commerce",uni:"UNISA",course:"ECS1501",isbn:"9780357038314",emoji:"💰",color:"#d97706",seller:"Lerato P.",sellerRating:4.2,sellerAvg:"LP",sellerColor:"#d97706",badge:"",desc:"7th edition. Clean copy, no writing inside. A few sticky notes left in but easily removed."},
  {id:5,title:"Engineering Mathematics",author:"Stroud & Booth",price:350,condition:"Good",subject:"Engineering",uni:"Tshwane University of Technology",course:"ENG1001",isbn:"9780831134709",emoji:"📐",color:"#dc2626",seller:"Regan T.",sellerRating:4.7,sellerAvg:"RT",sellerColor:"#2a6b4f",badge:"Popular",desc:"7th edition. Excellent for first-year engineering. A few dog-eared pages but all exercises intact. Great companion for the module."},
  {id:6,title:"South African Law of Persons",author:"Visser & Potgieter",price:175,condition:"Fair",subject:"Law",uni:"University of Pretoria",course:"PVL101",isbn:"9780409123685",emoji:"⚖️",color:"#374151",seller:"Naledi V.",sellerRating:4.6,sellerAvg:"NV",sellerColor:"#1a56a0",badge:"",desc:"Some highlighter marks in chapter 5 and 6. Rest is clean. Sold with handwritten summary notes."},
  {id:7,title:"Gray's Anatomy for Students",author:"Drake et al.",price:480,condition:"New",subject:"Health Sciences",uni:"University of Pretoria",course:"ANA1001",isbn:"9780323393041",emoji:"🫀",color:"#be123c",seller:"Sasha M.",sellerRating:4.9,sellerAvg:"SM",sellerColor:"#be123c",badge:"Hot Deal",desc:"4th edition. Bought as backup copy. Spotless condition. Retails for R1,200. Includes online access card (unused)."},
  {id:8,title:"Introduction to Sociology",author:"Giddens & Sutton",price:165,condition:"Fair",subject:"Humanities",uni:"UNISA",course:"SOC1101",isbn:"9780393922233",emoji:"👥",color:"#0891b2",seller:"Kagiso B.",sellerRating:4.3,sellerAvg:"KB",sellerColor:"#0891b2",badge:"",desc:"8th edition. Yellow highlighter throughout but very helpful for following the key arguments. Good for ECS and humanities modules."},
];

const CATS = ["All","IT & Computer Science","Business & Commerce","Engineering","Law","Health Sciences","Humanities"];
let activecat = "All";

// ── RENDER CATEGORIES ──
function renderCats(){
  const el = document.getElementById('catChips');
  el.innerHTML = CATS.map(c=>`<div class="cat-chip${c===activecat?' active':''}" onclick="setCat('${c}')">${c}</div>`).join('');
}

function setCat(c){activecat=c;renderCats();filterBooks();}

// ── RENDER BOOKS ──
function condClass(c){return c==='New'?'cond-new':c==='Good'?'cond-good':'cond-fair';}

function renderBooks(list){
  const el = document.getElementById('bookGrid');
  if(!list.length){el.innerHTML='<p style="color:var(--muted);grid-column:1/-1;padding:40px 0;text-align:center;">No listings found. Try adjusting your filters.</p>';return;}
  el.innerHTML = list.map(b=>`
    <div class="book-card" onclick="openBookDetail(${b.id})">
      <div class="book-cover" style="background:${b.color}22;">
        ${b.badge?`<div class="book-badge${b.badge==='Like New'?' verified':''}">${b.badge}</div>`:''}
        <span style="font-size:2.8rem">${b.emoji}</span>
      </div>
      <div class="book-info">
        <div class="book-title">${b.title}</div>
        <div class="book-author">${b.author}</div>
        <div class="book-meta">
          <div class="book-price">R${b.price}</div>
          <span class="book-condition ${condClass(b.condition)}">${b.condition}</span>
        </div>
        <div class="book-seller">
          <div class="seller-avatar" style="background:${b.sellerColor}">${b.sellerAvg}</div>
          ${b.seller}
          <span class="stars">★ ${b.sellerRating}</span>
        </div>
      </div>
    </div>
  `).join('');
}

function filterBooks(){
  const q = document.getElementById('mainSearch').value.toLowerCase();
  const subj = document.getElementById('filterSubject').value;
  const uni = document.getElementById('filterUni').value;
  const cond = document.getElementById('filterCond').value;
  let list = BOOKS.filter(b=>{
    const matchQ = !q || b.title.toLowerCase().includes(q)||b.author.toLowerCase().includes(q)||b.course.toLowerCase().includes(q)||b.isbn.includes(q);
    const matchS = !subj || b.subject===subj;
    const matchU = !uni || b.uni===uni;
    const matchC = !cond || b.condition===cond;
    const matchCat = activecat==='All' || b.subject===activecat;
    return matchQ&&matchS&&matchU&&matchC&&matchCat;
  });
  renderBooks(list);
}

// ── HERO MINI BOOKS ──
function renderHeroBooks(){
  const el = document.getElementById('heroBooks');
  el.innerHTML = BOOKS.slice(0,4).map(b=>`
    <div class="mini-book" onclick="openBookDetail(${b.id})">
      <div class="book-spine" style="background:${b.color}">${b.emoji}</div>
      <div class="mini-book-info">
        <div class="mini-book-title">${b.title}</div>
        <div class="mini-book-sub">${b.course} · ${b.condition}</div>
      </div>
      <div class="mini-book-price">R${b.price}</div>
    </div>
  `).join('');
}

// ── BOOK DETAIL ──
function openBookDetail(id){
  const b = BOOKS.find(x=>x.id===id);
  if(!b) return;
  const el = document.getElementById('book-detail-content');
  el.innerHTML = `
    <div class="book-detail-grid">
      <div class="book-detail-cover" style="background:${b.color}22;font-size:3.5rem">${b.emoji}</div>
      <div>
        <div class="detail-price">R${b.price}</div>
        <h2 style="font-family:'Playfair Display',serif;font-size:1.2rem;line-height:1.3;margin-bottom:6px">${b.title}</h2>
        <p style="color:var(--muted);font-size:.85rem;margin-bottom:12px">${b.author}</p>
        <div class="detail-tags">
          <span class="detail-tag">${b.condition}</span>
          <span class="detail-tag">${b.course}</span>
          <span class="detail-tag">${b.subject}</span>
        </div>
      </div>
    </div>
    <div class="detail-section">
      <h4>Description</h4>
      <p style="font-size:.875rem;line-height:1.7;color:var(--muted)">${b.desc}</p>
    </div>
    <div class="detail-section">
      <h4>Details</h4>
      <div style="display:grid;grid-template-columns:1fr 1fr;gap:8px;font-size:.82rem">
        <div><strong>ISBN:</strong> ${b.isbn}</div>
        <div><strong>University:</strong> ${b.uni}</div>
      </div>
    </div>
    <div class="detail-section">
      <h4>Seller</h4>
      <div class="seller-card">
        <div class="seller-av-lg" style="background:${b.sellerColor}">${b.sellerAvg}</div>
        <div>
          <div class="seller-name">${b.seller}</div>
          <div class="seller-stats">★ ${b.sellerRating} rating · Verified Student</div>
        </div>
      </div>
    </div>
    <div style="display:grid;grid-template-columns:1fr 1fr;gap:10px;margin-top:8px">
      <button class="btn btn-accent" style="padding:12px" onclick="contactSeller('${b.seller}')">💬 Message Seller</button>
      <button class="btn btn-green" style="padding:12px" onclick="buyBook(${b.price})">🔒 Buy Securely</button>
    </div>
  `;
  openModal('book-modal');
}

function contactSeller(name){
  showToast(`💬 Opening chat with ${name}…`);
  setTimeout(()=>closeModal('book-modal'),600);
}
function buyBook(price){
  showToast(`🔒 Escrow checkout initiated for R${price}`);
  setTimeout(()=>closeModal('book-modal'),600);
}

// ── MODALS ──
function openModal(id){document.getElementById(id).classList.add('open');}
function closeModal(id){document.getElementById(id).classList.remove('open');}
function closeModalOnBg(e,id){if(e.target===e.currentTarget)closeModal(id);}

function switchTab(t){
  document.querySelectorAll('.tab-btn').forEach((b,i)=>{b.classList.toggle('active',(i===0&&t==='login')||(i===1&&t==='signup'));});
  document.getElementById('login-form').style.display=t==='login'?'':'none';
  document.getElementById('signup-form').style.display=t==='signup'?'':'none';
}

function fakeLogin(){
  closeModal('auth-modal');
  showToast('✅ Welcome to BookBridge! Verification email sent.');
}

function submitListing(){
  closeModal('sell-modal');
  showToast('📚 Listing published! Students can now find your book.');
}

// ── SEARCH ──
function doSearch(){
  const q = document.getElementById('heroSearchInput').value;
  document.getElementById('mainSearch').value = q;
  document.querySelector('.search-bar-section').scrollIntoView({behavior:'smooth'});
  setTimeout(filterBooks, 400);
}

// ── TOAST ──
let toastTimer;
function showToast(msg,icon='✅'){
  clearTimeout(toastTimer);
  document.getElementById('toast-msg').textContent = msg;
  document.getElementById('toast-icon').textContent = icon;
  const t = document.getElementById('toast');
  t.classList.add('show');
  toastTimer = setTimeout(()=>t.classList.remove('show'),3500);
}

// ── MOBILE MENU ──
function toggleMobileMenu(){showToast('📱 Mobile menu coming soon!');}

// ── INIT ──
renderCats();
renderBooks(BOOKS);
renderHeroBooks();

document.getElementById('heroSearchInput').addEventListener('keydown',e=>{if(e.key==='Enter')doSearch();});
document.getElementById('mainSearch').addEventListener('keydown',e=>{if(e.key==='Enter')filterBooks();});

