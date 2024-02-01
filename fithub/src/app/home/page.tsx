import Link from "next/link";

export default function Home() {
  return (
    <div className="flex flex-col items-center h-screen bg-white">
      <div className="sticky top-0 bg-orange-500 flex items-center p-4 w-full">
        <img src="/usuario.png" alt="Usuario" className="w-10 h-10 mr-2" />
        <h1 className="font-bold">Benvingut @usuari</h1>
      </div>
      <div>
        {/* Resto del contenido */}
        <div>

        </div>
      </div>
    </div>
  );
}
