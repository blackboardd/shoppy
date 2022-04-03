import { Buffer } from 'buffer';

/**
 * Function to generate SKUs from the name of the product.
 *
 * @param name The name of the product.
 * @returns The SKU of the product.
 */
export const generateSKU = (name: string): string => {
  if (!name) return 'SKU';

  // get random series of characters with a length of 16
  const random = Math.random().toString(36).substring(2, 16);

  // mix the name and the random series of characters at random positions
  const mixed = name.split('').reduce((acc, char) => {
    const randomIndex = Math.floor(Math.random() * (acc.length + 1));
    acc.splice(randomIndex, 0, char);
    return acc;
  }, random.split(''));

  // convert the mixed array to a string
  const mixedString = mixed.join('');

  // base 64 encode name
  const b64Name = Buffer.from(mixedString).toString('base64');

  return b64Name.substring(0, 16).toUpperCase();
};
