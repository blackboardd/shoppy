import { UNIT, UNIT_TYPE } from '../components/interface';
import { ProductType, Unit } from '../components/types';

/**
 * Function to combine unit values based on the type of the product, be it a disc, furniture, or book.
 */
export const combineUnits = (
  unit: string,
  unitValue: string,
  type: string
): string => {
  const unitType = UNIT_TYPE[type as ProductType];
  const formattedUnit = UNIT[unit as Unit];

  switch (type) {
    case 'DISC':
      return `${unitType}: ${unitValue}${formattedUnit}`;
    case 'FURNITURE':
      return `${unitType}: ${unitValue}`;
    case 'BOOK':
      return `${unitType}: ${unitValue}${formattedUnit}`;
    default:
      return '';
  }
};
