// Helper to get URL parameter
function getQueryParam(param) {
  const urlParams = new URLSearchParams(window.location.search);
  return urlParams.get(param);
}

// Get product ID from URL (e.g. product.html?id=A1)
const productId = getQueryParam("id");

fetch("data_updated1.json")
  .then(response => response.json())
  .then(data => {
    const product = data.find(p => p.id.toUpperCase() === productId.toUpperCase());

    if (!product) {
      document.body.innerHTML = "<h1>Product not found</h1>";
      return;
    }

    // --- Product details ---
    document.getElementById("page-title").innerText = product.name;
    document.getElementById("item-code").innerText = product.itemCode;
    document.getElementById("product-name").innerText = product.name;
    document.getElementById("product-desc").innerText = product.description;
    document.getElementById("product-image").src = product.image;

    // ---- Advantages ----
    const advContainer = document.getElementById("advantages-container");
    const hasAdvantages = product.advantages && product.advantages.some(
      section => (section.heading && section.heading.trim() !== "") ||
                 (section.items && section.items.length > 0)
    );

    if (hasAdvantages) {
      const advHeading = document.createElement("h1");
      advHeading.classList.add("advantageh");
      advHeading.innerText = "Advantage";
      advContainer.parentNode.insertBefore(advHeading, advContainer);

      product.advantages.forEach(section => {
        if (
          (section.heading && section.heading.trim() !== "") ||
          (section.items && section.items.length > 0)
        ) {
          const sectionDiv = document.createElement("div");
          sectionDiv.classList.add("section-block");

          if (section.heading && section.heading.trim() !== "") {
            const heading = document.createElement("h2");
            heading.innerText = section.heading;
            sectionDiv.appendChild(heading);
          }

          if (section.items && section.items.length > 0) {
            const ul = document.createElement("ul");
            section.items.forEach(item => {
              const li = document.createElement("li");
              li.innerText = item;
              ul.appendChild(li);
            });
            sectionDiv.appendChild(ul);
          }

          advContainer.appendChild(sectionDiv);
        }
      });
    }

    // ---- Specifications ----
    const specTable = document.getElementById("specifications-table");
    if (product.specs && product.specs.length > 0) {
      const specHeading = document.createElement("h2");
      specHeading.classList.add("tableh");
      specHeading.innerText = "Model Specifications";
      specTable.parentNode.insertBefore(specHeading, specTable);

      product.specs.forEach((row, index) => {
        const tr = document.createElement("tr");
        row.forEach(cell => {
          const cellElement = document.createElement(index === 0 ? "th" : "td");
          cellElement.innerText = cell;
          tr.appendChild(cellElement);
        });
        specTable.appendChild(tr);
      });
    } else {
      specTable.parentNode.style.display = "none"; // hide empty table
    }

    // ---- Dimension Drawing ----
    const dimensionContainer = document.getElementById("dimension-container");
    if (product.dimensionImage && product.dimensionImage.trim() !== "") {
      const dimensionHeading = document.createElement("h1");
      dimensionHeading.classList.add("dimensionh");
      dimensionHeading.innerText = "Dimension Drawing";
      dimensionContainer.appendChild(dimensionHeading);

      const img = document.createElement("img");
      img.id = "dimension-image";
      img.src = product.dimensionImage;
      img.alt = "Dimension Drawing";
      img.style.width = "100%";
      dimensionContainer.appendChild(img);
    } else {
      document.querySelector(".dimention-drawing").style.display = "none";
    }
  })
  .catch(error => {
    console.error("Error loading product data:", error);
    alert("Failed to load product details. Check console for more info.");
  });
