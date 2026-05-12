#!/bin/bash
cd "$(dirname "$0")"
echo "🎨 Compilando SCSS..."
echo "Observando cambios en style.scss"
echo "Presiona Ctrl+C para detener"
echo ""
sass --watch --style=compressed --no-source-map assets/scss/style.scss:assets/css/style.css
