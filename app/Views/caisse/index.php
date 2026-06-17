<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Caisse · Marché</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Barlow+Condensed:wght@500;600;700&family=Inter:wght@400;500;600&family=IBM+Plex+Mono:wght@500;600&display=swap" rel="stylesheet">
<style>
  :root{
    --bg:#F6F4ED;--surface:#FFFFFF;--surface-alt:#FBF9F3;--ink:#1E2A22;--ink-soft:#5B6962;
    --primary:#1C6B4A;--primary-dark:#103F2C;--primary-soft:#E4F1EA;
    --accent:#E8A33D;--accent-dark:#C97F1B;--line:#E2DED2;
    --danger:#B23A2E;--danger-soft:#F6E4E0;
    --display-bg:#0F2C20;--display-fg:#F4C94C;
    --radius:8px;--shadow:0 1px 2px rgba(16,40,28,.06),0 6px 16px rgba(16,40,28,.07);
  }
  *{box-sizing:border-box;}
  html,body{margin:0;padding:0;}
  body{background:var(--bg);color:var(--ink);font-family:'Inter',system-ui,sans-serif;min-height:100vh;}
  h1,h2,h3,.label-caps,button,.nav a,.brand{font-family:'Barlow Condensed',sans-serif;}
  .num{font-family:'IBM Plex Mono',monospace;}
  .screen{display:none;min-height:100vh;}
  .screen.active{display:flex;flex-direction:column;}

  /* Login */
  #screen-login{align-items:center;justify-content:center;background:var(--primary-dark);position:relative;overflow:hidden;}
  #screen-login::before{content:"";position:absolute;inset:0;background:repeating-linear-gradient(90deg,rgba(255,255,255,.05) 0 2px,transparent 2px 6px,rgba(255,255,255,.05) 6px 9px,transparent 9px 18px);opacity:.5;}
  .login-mark{position:relative;z-index:1;text-align:center;margin-bottom:28px;}
  .login-mark .mark{width:46px;height:46px;border-radius:10px;background:var(--accent);display:inline-flex;align-items:center;justify-content:center;font-family:'IBM Plex Mono',monospace;font-weight:600;color:var(--primary-dark);font-size:20px;margin-bottom:14px;}
  .login-mark h1{color:#fff;margin:0;font-size:28px;font-weight:600;letter-spacing:.5px;}
  .login-mark p{color:#bcd3c6;margin:4px 0 0;font-size:13px;letter-spacing:1.5px;text-transform:uppercase;}
  .card{position:relative;z-index:1;background:var(--surface);border-radius:var(--radius);box-shadow:var(--shadow);padding:32px;width:100%;max-width:360px;}
  .card h2{margin:0 0 18px;font-size:20px;font-weight:600;}
  .field{margin-bottom:16px;}
  .field label{display:block;font-size:12px;color:var(--ink-soft);margin-bottom:6px;font-family:'Inter';text-transform:uppercase;letter-spacing:.6px;}
  .field input,.field select{width:100%;padding:10px 12px;border:1px solid var(--line);border-radius:6px;font-size:15px;font-family:'Inter';background:var(--surface-alt);color:var(--ink);}
  .field input:focus,.field select:focus{outline:2px solid var(--primary);outline-offset:1px;border-color:var(--primary);}
  .btn{border:none;border-radius:6px;padding:11px 18px;font-size:15px;font-weight:600;cursor:pointer;font-family:'Barlow Condensed',sans-serif;letter-spacing:.3px;display:inline-flex;align-items:center;justify-content:center;gap:6px;}
  .btn:focus-visible{outline:2px solid var(--primary-dark);outline-offset:2px;}
  .btn-primary{background:var(--primary);color:#fff;width:100%;}
  .btn-primary:hover{background:var(--primary-dark);}
  .btn-primary:disabled{background:#a9bdb3;cursor:not-allowed;}
  .btn-accent{background:var(--accent);color:var(--primary-dark);}
  .btn-accent:hover{background:var(--accent-dark);color:#fff;}
  .btn-ghost{background:transparent;color:var(--ink-soft);border:1px solid var(--line);}
  .btn-ghost:hover{border-color:var(--ink-soft);color:var(--ink);}
  .btn-danger{background:var(--danger);color:#fff;}
  .btn-danger:hover{background:#8f2e24;}
  .error-msg{background:var(--danger-soft);color:var(--danger);font-size:13px;padding:8px 10px;border-radius:6px;margin-bottom:14px;display:none;}
  .hint{color:#9fb5ab;font-size:12px;text-align:center;margin-top:16px;position:relative;z-index:1;}

  /* Header */
  .topbar-info{background:var(--primary-dark);color:#fff;display:flex;align-items:center;justify-content:space-between;padding:0 24px;height:48px;flex-wrap:wrap;gap:10px;}
  .brand{display:flex;align-items:center;gap:10px;font-size:18px;font-weight:600;color:#fff;}
  .brand .mark{width:26px;height:26px;border-radius:6px;background:var(--accent);display:inline-flex;align-items:center;justify-content:center;font-family:'IBM Plex Mono',monospace;font-weight:600;color:var(--primary-dark);font-size:12px;}
  .caisse-line{display:flex;align-items:center;gap:8px;font-family:'IBM Plex Mono',monospace;font-size:14px;letter-spacing:.3px;color:var(--display-fg);}
  .caisse-line .dot{width:6px;height:6px;border-radius:50%;background:var(--display-fg);margin-right:8px;}
  .session-info{display:flex;align-items:center;gap:14px;}
  .user-badge{font-size:13px;color:#cfe3d8;margin-right:14px;}
  .logout-link{color:#cfe3d8;text-decoration:none;font-size:13px;border-bottom:1px solid transparent;cursor:pointer;}
  .logout-link:hover{color:#fff;border-bottom-color:#fff;}
  .topbar-menu{background:var(--surface);border-bottom:1px solid var(--line);display:flex;align-items:center;gap:22px;padding:0 24px;height:46px;}
  .nav{display:flex;align-items:center;gap:22px;}
  .nav a{color:var(--ink-soft);text-decoration:none;font-size:15px;font-weight:600;letter-spacing:.3px;cursor:pointer;padding:4px 2px;border-bottom:2px solid transparent;}
  .nav a.active{color:var(--primary-dark);border-bottom-color:var(--accent);}
  .nav a:hover{color:var(--primary-dark);}
  .content{padding:28px 24px;flex:1;width:100%;max-width:980px;margin:0 auto;}
  .content h2{font-size:22px;margin:0 0 4px;font-weight:600;}
  .subtext{color:var(--ink-soft);font-size:14px;margin:0 0 22px;}

  /* Choix caisse */
  .caisse-grid{display:grid;grid-template-columns:repeat(auto-fit,minmax(160px,1fr));gap:16px;max-width:520px;margin-bottom:26px;}
  .caisse-tile{background:var(--surface);border:2px solid var(--line);border-radius:var(--radius);padding:22px 16px;text-align:center;cursor:pointer;transition:.15s;}
  .caisse-tile:hover{border-color:var(--primary);}
  .caisse-tile.selected{border-color:var(--primary);background:var(--primary-soft);}
  .caisse-tile .num{display:block;font-size:34px;font-weight:600;color:var(--primary-dark);}
  .caisse-tile .lbl{font-size:13px;color:var(--ink-soft);margin-top:4px;}
  .status-dot{display:inline-block;width:7px;height:7px;border-radius:50%;background:var(--primary);margin-right:5px;}

  /* Saisie achat */
  .panel{background:var(--surface);border:1px solid var(--line);border-radius:var(--radius);padding:20px 22px;margin-bottom:20px;}
  .panel h3{margin:0 0 16px;font-size:16px;font-weight:600;color:var(--primary-dark);text-transform:uppercase;letter-spacing:.5px;}
  .add-row{display:flex;align-items:flex-end;gap:14px;flex-wrap:wrap;}
  .add-row .field{margin-bottom:0;flex:1;min-width:170px;}
  .add-row .field.small{flex:0 0 110px;min-width:110px;}
  .readonly-field{padding:10px 12px;border:1px solid var(--line);border-radius:6px;background:var(--surface-alt);font-family:'IBM Plex Mono',monospace;font-size:14px;color:var(--ink-soft);}
  .qty-stepper{display:flex;align-items:center;border:1px solid var(--line);border-radius:6px;overflow:hidden;background:var(--surface-alt);}
  .qty-stepper button{background:transparent;border:none;width:32px;height:38px;font-size:16px;color:var(--primary-dark);cursor:pointer;}
  .qty-stepper button:hover{background:var(--primary-soft);}
  .qty-stepper input{width:48px;border:none;text-align:center;background:transparent;font-family:'IBM Plex Mono',monospace;font-size:14px;color:var(--ink);padding:0;}
  .qty-stepper input:focus{outline:none;}
  table.cart{width:100%;border-collapse:collapse;}
  table.cart th{text-align:left;font-size:12px;text-transform:uppercase;letter-spacing:.5px;color:var(--ink-soft);font-weight:600;padding:0 10px 10px;border-bottom:1px solid var(--line);}
  table.cart td{padding:11px 10px;border-bottom:1px solid var(--line);font-size:14px;}
  table.cart td.num,table.cart th.num{text-align:right;font-family:'IBM Plex Mono',monospace;}
  table.cart tr:last-child td{border-bottom:none;}
  .row-remove{background:none;border:none;color:var(--ink-soft);cursor:pointer;font-size:13px;}
  .row-remove:hover{color:var(--danger);}
  .empty-cart{text-align:center;color:var(--ink-soft);padding:30px 0;font-size:14px;}
  .cart-footer{display:flex;align-items:center;justify-content:space-between;margin-top:18px;flex-wrap:wrap;gap:16px;}
  .display-total{background:var(--display-bg);color:var(--display-fg);border-radius:8px;padding:12px 20px;display:flex;align-items:baseline;gap:10px;box-shadow:inset 0 0 0 1px rgba(255,255,255,.06);}
  .display-total .lbl{font-family:'Barlow Condensed',sans-serif;font-size:12px;letter-spacing:1.5px;text-transform:uppercase;color:#7fa794;}
  .display-total .amount{font-family:'IBM Plex Mono',monospace;font-size:28px;font-weight:600;letter-spacing:.5px;}
  .cart-actions{display:flex;gap:10px;flex-wrap:wrap;}
  .toast{position:fixed;bottom:24px;left:50%;transform:translateX(-50%) translateY(20px);background:var(--primary-dark);color:#fff;padding:12px 22px;border-radius:8px;font-size:14px;box-shadow:var(--shadow);opacity:0;transition:.25s;pointer-events:none;font-family:'Inter';}
  .toast.show{opacity:1;transform:translateX(-50%) translateY(0);}

  /* Catalogue */
  table.catalog{width:100%;border-collapse:collapse;background:var(--surface);border:1px solid var(--line);border-radius:var(--radius);overflow:hidden;}
  table.catalog th{background:var(--surface-alt);text-align:left;font-size:12px;text-transform:uppercase;letter-spacing:.5px;color:var(--ink-soft);font-weight:600;padding:12px 16px;border-bottom:1px solid var(--line);}
  table.catalog td{padding:13px 16px;border-bottom:1px solid var(--line);font-size:14px;}
  table.catalog tr:last-child td{border-bottom:none;}
  table.catalog td.num,table.catalog th.num{text-align:right;font-family:'IBM Plex Mono',monospace;}
  .stock-low{color:var(--danger);font-weight:600;}

  @media(max-width:640px){
    .topbar-info{height:auto;padding:10px 16px;}
    .topbar-menu{height:auto;padding:10px 16px;}
    .nav{width:100%;justify-content:space-between;}
    .content{padding:20px 16px;}
    .add-row{flex-direction:column;align-items:stretch;}
    .add-row .field,.add-row .field.small{width:100%;}
  }
</style>
</head>
<body>

<!-- ============ LOGIN ============ -->
<section class="screen active" id="screen-login">
  <div>
    <div class="login-mark">
      <div class="mark">C·M</div>
      <h1>Caisse · Marché</h1>
      <p>Espace caissier</p>
    </div>
    <div class="card">
      <h2>Connexion</h2>
      <div class="error-msg" id="login-error">Identifiant ou mot de passe incorrect.</div>
      <div class="field">
        <label for="login-user">Identifiant</label>
        <input id="login-user" type="text" placeholder="ex. jdupont" autocomplete="username">
      </div>
      <div class="field">
        <label for="login-pass">Mot de passe</label>
        <input id="login-pass" type="password" placeholder="••••••••" autocomplete="current-password">
      </div>
      <button class="btn btn-primary" onclick="handleLogin()">Se connecter</button>
    </div>
  </div>
</section>

<!-- ============ CHOIX CAISSE ============ -->
<section class="screen" id="screen-caisse">
  <div class="topbar-info">
    <div class="brand"><span class="mark">C·M</span> Caisse · Marché</div>
    <div class="session-info">
      <span class="user-badge" id="caisse-user-badge">Bonjour, —</span>
      <a class="logout-link" onclick="logout()">Déconnexion</a>
    </div>
  </div>
  <div class="content">
    <h2>Choisissez votre caisse</h2>
    <p class="subtext">Sélectionnez le numéro de caisse sur lequel vous travaillez, puis validez.</p>
    <div class="caisse-grid" id="caisse-grid"></div>
    <button class="btn btn-primary" style="max-width:220px;" id="btn-valider-caisse" disabled onclick="validerCaisse()">Valider</button>
  </div>
</section>

<!-- ============ SAISIE ACHAT ============ -->
<section class="screen" id="screen-achat">
  <div class="topbar-info">
    <div class="brand"><span class="mark">C·M</span> Caisse · Marché</div>
    <div class="caisse-line" id="achat-caisse-line"><span class="dot"></span>Caisse —</div>
    <div class="session-info">
      <span class="user-badge" id="achat-user-badge">—</span>
      <a class="logout-link" onclick="logout()">Déconnexion</a>
    </div>
  </div>
  <div class="topbar-menu">
    <div class="nav">
      <a class="active" data-nav="achat" onclick="goNav('achat')">Accueil</a>
      <a data-nav="produits" onclick="goNav('produits')">Produits</a>
    </div>
  </div>
  <div class="content">
    <h2>Saisie des achats</h2>
    <p class="subtext">Recherchez un article pour l'ajouter au panier du client en cours.</p>
    <div class="panel">
      <h3>Ajouter un article</h3>
      <div class="add-row">
        <div class="field">
          <label for="select-produit">Désignation</label>
          <select id="select-produit" onchange="onProductChange()">
            <option value="">— Choisir un produit —</option>
          </select>
        </div>
        <div class="field small">
          <label>Prix unitaire</label>
          <div class="readonly-field" id="champ-prix">—</div>
        </div>
        <div class="field small">
          <label>Stock dispo.</label>
          <div class="readonly-field" id="champ-stock">—</div>
        </div>
        <div class="field small">
          <label>Quantité</label>
          <div class="qty-stepper">
            <button type="button" onclick="stepQty(-1)">−</button>
            <input id="champ-qte" type="number" min="1" value="1" inputmode="numeric">
            <button type="button" onclick="stepQty(1)">+</button>
          </div>
        </div>
        <button class="btn btn-accent" id="btn-ajouter" onclick="addToCart()" disabled>Ajouter au panier</button>
      </div>
    </div>
    <div class="panel">
      <h3>Panier en cours</h3>
      <table class="cart">
        <thead><tr>
          <th>Désignation</th>
          <th class="num">Prix unit.</th>
          <th class="num">Qté</th>
          <th class="num">Sous-total</th>
          <th></th>
        </tr></thead>
        <tbody id="cart-body"></tbody>
      </table>
      <div class="empty-cart" id="cart-empty">Le panier est vide pour le moment.</div>
      <div class="cart-footer">
        <div class="display-total">
          <span class="lbl">Total</span>
          <span class="amount num" id="cart-total">0,00 €</span>
        </div>
        <div class="cart-actions">
          <button class="btn btn-ghost" onclick="viderPanier()">Vider le panier</button>
          <button class="btn btn-danger" onclick="cloturerAchat()">Clôturer l'achat</button>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- ============ PRODUITS ============ -->
<section class="screen" id="screen-produits">
  <div class="topbar-info">
    <div class="brand"><span class="mark">C·M</span> Caisse · Marché</div>
    <div class="caisse-line" id="produits-caisse-line"><span class="dot"></span>Caisse —</div>
    <div class="session-info">
      <span class="user-badge" id="produits-user-badge">—</span>
      <a class="logout-link" onclick="logout()">Déconnexion</a>
    </div>
  </div>
  <div class="topbar-menu">
    <div class="nav">
      <a data-nav="achat" onclick="goNav('achat')">Accueil</a>
      <a class="active" data-nav="produits" onclick="goNav('produits')">Produits</a>
    </div>
  </div>
  <div class="content">
    <h2>Catalogue produits</h2>
    <p class="subtext">Liste des articles disponibles en magasin.</p>
    <table class="catalog">
      <thead><tr>
        <th>Désignation</th>
        <th class="num">Prix</th>
        <th class="num">Stock</th>
      </tr></thead>
      <tbody id="catalog-body"></tbody>
    </table>
  </div>
</section>

<div class="toast" id="toast"></div>

<script>
/* ---------------------------------------------------------------
   URLs des endpoints CodeIgniter (définies côté PHP)
----------------------------------------------------------------*/
const API = {
  login:     '<?= site_url('api/login') ?>',
  logout:    '<?= site_url('api/logout') ?>',
  caisses:   '<?= site_url('api/caisses') ?>',
  produits:  '<?= site_url('api/produits') ?>',
  achat:     '<?= site_url('api/achat/creer') ?>',
};

/* ---------------------------------------------------------------
   État applicatif
----------------------------------------------------------------*/
let session = { userId: null, username: null, caisseId: null, caisseName: null };
let PRODUITS = [];   // chargés depuis l'API
let CAISSES  = [];   // chargés depuis l'API
let panier   = [];   // { produitId, designation, prix, stock, qte }

/* ---------------------------------------------------------------
   Utilitaires
----------------------------------------------------------------*/
function fmt(n){ return n.toFixed(2).replace('.', ',') + ' €'; }

function showScreen(id){
  document.querySelectorAll('.screen').forEach(s => s.classList.remove('active'));
  document.getElementById(id).classList.add('active');
}

function showToast(msg){
  const t = document.getElementById('toast');
  t.textContent = msg;
  t.classList.add('show');
  setTimeout(() => t.classList.remove('show'), 2200);
}

async function apiFetch(url, opts = {}){
  const res = await fetch(url, {
    headers: { 'Content-Type': 'application/json', 'X-Requested-With': 'XMLHttpRequest' },
    ...opts
  });
  return res.json();
}

/* ---------------------------------------------------------------
   LOGIN
----------------------------------------------------------------*/
async function handleLogin(){
  const username = document.getElementById('login-user').value.trim();
  const mdp      = document.getElementById('login-pass').value;
  const errDiv   = document.getElementById('login-error');
  errDiv.style.display = 'none';

  if(!username || !mdp){ errDiv.style.display = 'block'; return; }

  try {
    const data = await apiFetch(API.login, {
      method: 'POST',
      body: JSON.stringify({ username, mdp })
    });

    if(data.success){
      session.userId   = data.user.id;
      session.username = data.user.username;
      document.getElementById('caisse-user-badge').textContent = 'Bonjour, ' + session.username;
      await loadCaisses();
      showScreen('screen-caisse');
    } else {
      errDiv.style.display = 'block';
    }
  } catch(e){
    errDiv.textContent = 'Erreur réseau. Réessayez.';
    errDiv.style.display = 'block';
  }
}

/* ---------------------------------------------------------------
   LOGOUT
----------------------------------------------------------------*/
async function logout(){
  await apiFetch(API.logout, { method: 'POST' });
  session = { userId:null, username:null, caisseId:null, caisseName:null };
  panier = [];
  document.getElementById('login-user').value = '';
  document.getElementById('login-pass').value = '';
  showScreen('screen-login');
}

/* ---------------------------------------------------------------
   CHOIX CAISSE
----------------------------------------------------------------*/
async function loadCaisses(){
  const data = await apiFetch(API.caisses);
  CAISSES = data.caisses || [];
  renderCaisseGrid();
}

function renderCaisseGrid(){
  const grid = document.getElementById('caisse-grid');
  grid.innerHTML = '';
  CAISSES.forEach(c => {
    const tile = document.createElement('div');
    tile.className = 'caisse-tile' + (session.caisseId === c.id ? ' selected' : '');
    tile.onclick = () => selectCaisse(c.id, c.nomDeCaisse);
    tile.innerHTML = `<span class="num">${c.id}</span><span class="lbl"><span class="status-dot"></span>${c.nomDeCaisse} · Libre</span>`;
    grid.appendChild(tile);
  });
}

function selectCaisse(id, name){
  session.caisseId   = id;
  session.caisseName = name;
  renderCaisseGrid();
  document.getElementById('btn-valider-caisse').disabled = false;
}

async function validerCaisse(){
  if(!session.caisseId) return;
  document.getElementById('achat-caisse-line').innerHTML    = '<span class="dot"></span>' + session.caisseName;
  document.getElementById('produits-caisse-line').innerHTML = '<span class="dot"></span>' + session.caisseName;
  document.getElementById('achat-user-badge').textContent   = session.username;
  document.getElementById('produits-user-badge').textContent= session.username;
  await loadProduits();
  renderCart();
  goNav('achat');
}

/* ---------------------------------------------------------------
   NAVIGATION
----------------------------------------------------------------*/
function goNav(target){
  document.querySelectorAll('.nav a[data-nav]').forEach(a => a.classList.toggle('active', a.dataset.nav === target));
  if(target === 'achat')    { showScreen('screen-achat'); }
  if(target === 'produits') { renderCatalog(); showScreen('screen-produits'); }
}

/* ---------------------------------------------------------------
   PRODUITS — chargement depuis l'API
----------------------------------------------------------------*/
async function loadProduits(){
  const data = await apiFetch(API.produits);
  PRODUITS = data.produits || [];
  populateProductSelect();
}

function populateProductSelect(){
  const sel = document.getElementById('select-produit');
  sel.innerHTML = '<option value="">— Choisir un produit —</option>';
  PRODUITS.forEach(p => {
    sel.innerHTML += `<option value="${p.id}">${p.designation}</option>`;
  });
}

function onProductChange(){
  const id = parseInt(document.getElementById('select-produit').value);
  const p  = PRODUITS.find(x => x.id === id);
  const btn = document.getElementById('btn-ajouter');
  if(!p){
    document.getElementById('champ-prix').textContent  = '—';
    document.getElementById('champ-stock').textContent = '—';
    btn.disabled = true;
    return;
  }
  document.getElementById('champ-prix').textContent  = fmt(p.prixUnitaire);
  document.getElementById('champ-stock').textContent = p.quantite + ' unités';
  document.getElementById('champ-qte').max = p.quantite;
  btn.disabled = (p.quantite <= 0);
}

function stepQty(delta){
  const input = document.getElementById('champ-qte');
  let v = parseInt(input.value || '1') + delta;
  if(v < 1) v = 1;
  input.value = v;
}

/* ---------------------------------------------------------------
   PANIER
----------------------------------------------------------------*/
function addToCart(){
  const id = parseInt(document.getElementById('select-produit').value);
  const p  = PRODUITS.find(x => x.id === id);
  if(!p) return;
  let qte = parseInt(document.getElementById('champ-qte').value || '1');
  if(qte < 1) qte = 1;
  if(qte > p.quantite){ showToast('Stock insuffisant pour ' + p.designation); return; }

  const existing = panier.find(l => l.produitId === p.id);
  if(existing){ existing.qte += qte; }
  else { panier.push({ produitId: p.id, designation: p.designation, prix: p.prixUnitaire, stock: p.quantite, qte }); }

  renderCart();
  document.getElementById('select-produit').value = '';
  document.getElementById('champ-qte').value = 1;
  onProductChange();
  showToast(p.designation + ' ajouté au panier');
}

function renderCart(){
  const body  = document.getElementById('cart-body');
  const empty = document.getElementById('cart-empty');
  body.innerHTML = '';
  if(panier.length === 0){
    empty.style.display = 'block';
  } else {
    empty.style.display = 'none';
    panier.forEach((l, idx) => {
      const st = l.prix * l.qte;
      const tr = document.createElement('tr');
      tr.innerHTML = `
        <td>${l.designation}</td>
        <td class="num">${fmt(l.prix)}</td>
        <td class="num">${l.qte}</td>
        <td class="num">${fmt(st)}</td>
        <td><button class="row-remove" onclick="removeLine(${idx})">Retirer</button></td>`;
      body.appendChild(tr);
    });
  }
  const total = panier.reduce((s, l) => s + l.prix * l.qte, 0);
  document.getElementById('cart-total').textContent = fmt(total);
}

function removeLine(idx){ panier.splice(idx, 1); renderCart(); }
function viderPanier(){ panier = []; renderCart(); }

async function cloturerAchat(){
  if(panier.length === 0){ showToast('Le panier est déjà vide.'); return; }

  try {
    const payload = {
      idUser:   session.userId,
      idCaisse: session.caisseId,
      lignes:   panier.map(l => ({ idProduit: l.produitId, quantite: l.qte }))
    };
    const data = await apiFetch(API.achat, { method: 'POST', body: JSON.stringify(payload) });

    if(data.success){
      panier = [];
      renderCart();
      await loadProduits(); // rafraîchir les stocks
      showToast('Achat clôturé — panier vidé pour le prochain client.');
    } else {
      showToast('Erreur : ' + (data.message || 'impossible de clôturer'));
    }
  } catch(e){
    showToast('Erreur réseau lors de la clôture.');
  }
}

/* ---------------------------------------------------------------
   CATALOGUE
----------------------------------------------------------------*/
function renderCatalog(){
  const body = document.getElementById('catalog-body');
  body.innerHTML = '';
  PRODUITS.forEach(p => {
    const low = p.quantite <= 10;
    body.innerHTML += `
      <tr>
        <td>${p.designation}</td>
        <td class="num">${fmt(p.prixUnitaire)}</td>
        <td class="num ${low ? 'stock-low' : ''}">${p.quantite}</td>
      </tr>`;
  });
}
</script>
</body>
</html>
