# GCNam API Assignment

## 📌 Objective
This project is part of a job application assignment for GCNam. It demonstrates my ability to build:
- A **RESTful PHP API** to process booking data
- A **frontend UI** to send requests and visualize results
- A connection to a **remote API** for rate lookup

---

## ⚙️ How It Works

### 🧩 Backend (`/backend/index.php`)
- Accepts JSON with: unit name, arrival, departure, occupants, and ages
- Converts the format to the remote API spec
- Posts to: `https://dev.gondwana-collection.com/Web-Store/Rates/Rates.php`
- Returns rates back to the frontend

### 💻 Frontend (`/frontend/index.html`)
- Simple UI form
- User inputs booking details
- Displays the response in a readable JSON format

---

## 🚀 How to Run Locally (or in Codespaces)

```bash
php -S 0.0.0.0:3000
Then open:

bash
Copy
Edit
https://potential-adventure-4979w5p796rfqjxq-3000.app.github.dev/frontend/index.html
If using Codespaces: open the corresponding GitHub Codespace port in your browser.

✅ Testing Sample Data
Use this sample:

Unit Name: Room

Arrival: 14/06/2025

Departure: 16/06/2025

Occupants: 2

Ages: 27, 26


👨‍💻 Developer
Your Sany Sisamu

GitHub: sanysisamu

📎 Assignment Link
https://github.com/Sanysisamu/gcnam-api-assignment



---

## ✅ 2. `sonarcloud.yml` (Place inside `.github/workflows/`)

If you created a SonarCloud project already, replace the placeholder values below:

```yaml
name: SonarCloud

on:
  push:
    branches:
      - main
  pull_request:
    types: [opened, synchronize, reopened]
    branches:
      - main

jobs:
  build:
    name: SonarCloud Analysis
    runs-on: ubuntu-latest

    steps:
      - uses: actions/checkout@v3
        with:
          fetch-depth: 0 # Required by SonarCloud

      - name: Set up PHP
        uses: shivammathur/setup-php@v2
        with:
          php-version: '8.2'

      - name: Run SonarCloud Scan
        uses: SonarSource/sonarcloud-github-action@master
        env:
          SONAR_TOKEN: ${{ secrets.SONAR_TOKEN }}
        with:
          organization: sanysisamu
          projectKey: organization: sanysisamu
          projectKey: Sanysisamu_gcnam-api-assignment