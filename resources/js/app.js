import { createRoot } from 'react-dom/client';

function App() {
    return (
        <h1>こんにちは、React！</h1>
    );
}

createRoot(document.getElementById('app')).render(
    <App />
);